<?php

class Service_Upload
{
	public function post_upload_image()
    {
        Config::load('upload', true);

        if (Upload::is_valid()) {
            Upload::save();

            $files = Upload::get_files();
            $saved_file_name = $files[0]['saved_as'];
            $saved_file_path = $files[0]['saved_to'];

            return $saved_file_name;
        }
    }
}
