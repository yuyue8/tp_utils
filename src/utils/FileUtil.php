<?php

namespace Yuyue8\TpUtils\utils;

/**
 * 文件处理
 */
class FileUtil
{
    /**
     * 获取图片文件的访问路径
     *
     * @param string $path
     * @return array
     */
    public function getImagesFullPath(string $path)
    {
        if (empty($path)) {
            return [
                'img'     => '',
                'all_img' => ''
            ];
        } else {
            $position = strpos($path, '/images');

            $path = images_path() . ltrim(substr($path, $position == false ? 0 : ($position + 7)), '/');

            return [
                'img'     => $path,
                'all_img' => request()->domain() . $path
            ];
        }
    }

    /**
     * 删除图片文件
     *
     * @param string $path
     * @return bool
     */
    public function unImagesFile(string $path)
    {
        if (empty($path)) {
            return true;
        } else {
            $position = strpos($path, '/images');
            if ($position) {
                $path = substr($path, $position + 7);
            }

            $path = images_intact_path() . ltrim($path, DIRECTORY_SEPARATOR);

            return is_file($path) && unlink($path);
        }
    }
}
