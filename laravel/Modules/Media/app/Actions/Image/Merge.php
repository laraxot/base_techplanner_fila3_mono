<?php

declare(strict_types=1);

namespace Modules\Media\Actions\Image;

use Intervention\Image\ImageManager as InterventionImageManager;

class Merge
{
    

    public function execute(array $filenames, string $filenameOut): void
    {
        $width = 0;
        $height = 0;
        $imgs = [];
        foreach ($filenames as $filename) {
            // $img = Image::make(public_path($filename));
            if (! is_string($filename)) {
                continue;
            }
            $manager = new ImageManager(['driver' => 'gd']);
            $img = $manager->make(public_path($filename));

            $imgs[] = $img;
            $width += $img->width();
            $height = max($height, $img->height());
        }

        if (! is_numeric($height)) {
            throw new \Exception('['.__LINE__.']['.class_basename(self::class).']');
        }
        $height = (int) $height;
        // $img_canvas = Image::canvas($width, $height);

        $manager = new ImageManager(['driver' => 'gd']);
        $img_canvas = $manager->canvas($width, $height);

        $delta = 0;
        foreach ($imgs as $img) {
            // $img_canvas->insert($img, 'top-left ', $delta, 0);
            $img_canvas->place($img, 'top-left ', $delta, 0);
            $delta += $img->width();
        }

        $img_canvas->save(public_path().'/'.$filenameOut, 100);
    }
}
