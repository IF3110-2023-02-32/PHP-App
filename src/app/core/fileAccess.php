<?php

class FileAccess
{
    private $fileDir;

    public const PROFILES_PATH = '/profiles';
    public const BANNERS_PATH = '/banners';
    public const POSTS_PATH = '/posts';

    public const FILE_TYPE_PATH = [
        VIDEO_TYPE => '/videos/',
        AUDIO_TYPE => '/audios/',
        IMAGE_TYPE => '/images/'
    ];

    /**
     * Constructs file access object to store/remove files.
     * $dir is used to specify directory of file to be stored.
     */
    public function __construct(string $dir)
    {
        $this->fileDir = SRC_ROOT_PATH . '/storage' . $dir;
    }

    /**
     * Returns true if file exist in current FileAccess object directory
     */
    private function doesFileExist(string $filename)
    {
        return file_exists($this->fileeDir . $filename);
    }

    /**
     * Returns the file type (e.g. video, audio) based of MIME type
     */
    public function getFileTypeFromMIME(string $mimetype)
    {
        foreach (SUPPORTED_FILES as $filetype => $mimetoext) {
            if (in_array($mimetype, array_keys($mimetoext))) {
                return $filetype;
            }
        }

        return null;
    }

    /**
     * Returns the file type (e.g. video, audio) of specified file name
     */
    public function getFileType(string $filename)
    {
        $mimetype = mime_content_type($filename); // get file MIME type

        return $this->getFileTypeFromMIME($mimetype);
    }

    /**
     * Saves the file to its corresponding categorized directory.
     * Returns the new file name due to renaming for collision prevention
     */
    public function saveFileAuto(string $filename)
    {
        $mimetype = mime_content_type($filename); // get file MIME type
        $filetype = $this->getFileTypeFromMIME($mimetype);

        // Check the file type, if not supported, throw exception
        if (is_null($filetype)) {
            throw new LoggedException('Unsupported Media Type', 415);
        }

        // Check file size, if too large, throw exception
        $filesize = filesize($filename);
        if ($filesize > MAX_FILE_SIZE[$filetype]) {
            throw new LoggedException('Request Entity Too Large', 413);
        }

        $newDir = $this->storageDir . FileAccess::FILE_TYPE_PATH[$filetype];
        // Generate new file name to keep in same directory to prevent overwriting 
        do {
            $newfilename = md5(uniqid(mt_rand(), true)) . (SUPPORTED_FILES[$filetype])[$mimetype];
        } while (file_exists($newDir . $filename));

        $newfilepath = $newDir . $newfilename;
        $success = move_uploaded_file($filename, $newfilepath);
        if (!$success) {
            throw new LoggedException('Internal Server Error', 500);
        }

        return $newfilepath;
    }

    /**
     * Delete the specified file
     * specify $filetype to delete filename in specified directory associated with file type
     */
    public function deleteFile($filename, $filetype = null)
    {
        if (is_null($filetype)) {
            $filepath = FileAccess::FILE_TYPE_PATH[$filetype] . $filename;
        }
        else {
            $filepath = $filename;
        }
        
        if (!$this->doesFileExist($filepath)) {
            return;
        }

        $success = unlink($this->storageDir . $filepath);
        if (!$success) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }
}
