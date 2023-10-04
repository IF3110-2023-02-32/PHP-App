<?php

class fileAccess
{
    private $fileDir;

    public const PROFILES_PATH = 'profiles/';
    public const BANNERS_PATH = 'banners/';
    public const POSTS_PATH = 'posts/';

    public const FILE_TYPE_PATH = [
        VIDEO_TYPE => 'videos/',
        AUDIO_TYPE => 'audios/',
        IMAGE_TYPE => 'images/'
    ];

    /**
     * Constructs file access object to store/remove files.
     * $dir is used to specify directory of file to be stored.
     */
    public function __construct(string $dir)
    {
        $this->fileDir = __DIR__ . '/../../storage/' . $dir;
    }

    /**
     * Returns true if file exist in current fileAccess directory
     */
    private function doesFileExist(string $filename)
    {
        return file_exists($this->fileeDir . $filename);
    }

    /**
     * Returns the file type (e.g. video, audio) of specified file
     */
    public function getFileType(string $filename)
    {
        $mimetype = mime_content_type($filename); // get file MIME type

        foreach (SUPPORTED_FILES as $filetype => $mimetoext) {
            if (in_array($mimetype, array_keys($mimetoext))) {
                return $filetype;
            }
        }

        return null;
    }

    public function saveFile(string $filename)
    {
        $mimetype = mime_content_type($filename); // get file MIME type
        $filetype = $this->getFileType($filename);

        // Check the file type, if not supported, throw exception
        if (is_null($filetype)) {
            throw new LoggedException('Unsupported Media Type', 415);
        }

        // Check file size, if too large, throw exception
        $filesize = filesize($filename);
        if ($filesize > MAX_FILE_SIZE[$filetype]) {
            throw new LoggedException('Request Entity Too Large', 413);
        }

        $newDir = $this->storageDir . fileAccess::FILE_TYPE_PATH[$filetype];
        // Generate new file name to keep in same directory to prevent overwriting 
        do {
            $newfilename = md5(uniqid(mt_rand(), true)) . (SUPPORTED_FILES[$filetype])[$mimetype];
        } while (file_exists($newDir . $filename));

        $success = move_uploaded_file($filename, $newDir . $newfilename);
        if (!$success) {
            throw new LoggedException('Internal Server Error', 500);
        }

        return $newfilename;
    }

    /**
     * Delete the specified file
     * specify $filetype to delete filename in specified directory associated with file type
     */
    public function deleteFile($filename, $filetype = null)
    {
        if (is_null($filetype)) {
            $filepath = fileAccess::FILE_TYPE_PATH[$filetype] . $filename;
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
