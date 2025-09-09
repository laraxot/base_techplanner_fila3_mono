<?php

declare(strict_types=1);

namespace Modules\Media\Actions\Image;

use Intervention\Image\ImageManager as InterventionImageManager;

class Merge
{
    /**
     * Unisce due immagini in una sola.
     *
     * @param string $path1 Percorso della prima immagine
     * @param string $path2 Percorso della seconda immagine
     * @param string $outputPath Percorso di salvataggio
     * @return bool
     */
    public function handle(string $path1, string $path2, string $outputPath): bool
    {
        // Compatibile con Intervention Image v2 (Laravel 10):
        $manager = new InterventionImageManager(['driver' => 'gd']);

<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9c5e628 (.)
=======
>>>>>>> da8eaf7 (.)
        // Carica le immagini
        $image1 = $manager->make($path1);
        $image2 = $manager->make($path2);

        // Inserisce image2 sopra image1 (centrato)
        $image1->insert($image2, 'center');

        // Salva il risultato
        $image1->save($outputPath);

        return true;
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
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
            $manager = new ImageManager(new Driver());
            $img = $manager->read(public_path($filename));

            $imgs[] = $img;
            $width += $img->width();
            $height = max($height, $img->height());
        }

        if (! is_numeric($height)) {
            throw new \Exception('['.__LINE__.']['.class_basename(self::class).']');
        }
        $height = (int) $height;
        // $img_canvas = Image::canvas($width, $height);

        $manager = new ImageManager(Driver::class);
        $img_canvas = $manager->create($width, $height);

        $delta = 0;
        foreach ($imgs as $img) {
            // $img_canvas->insert($img, 'top-left ', $delta, 0);
            $img_canvas->place($img, 'top-left ', $delta, 0);
            $delta += $img->width();
        }

        $img_canvas->save(public_path().'/'.$filenameOut, 100);
>>>>>>> 1c3ced0 (.)
>>>>>>> 9c5e628 (.)
=======
>>>>>>> da8eaf7 (.)
    }
}
