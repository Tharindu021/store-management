<?php

namespace domain\Services\ImageServices;

use App\Models\Images;
use Illuminate\Support\Facades\Storage;


class ImageServices
{
    protected $image;

    public function __construct()
    {
        $this->image = new Images();
    }

    public function store($file)
    {
        if (isset($file)) {
            $filepath = Storage::disk('do')->putFile(config('filesystems.disks.do.folder'), $file, 'public');
            $data = config('filesystems.disks.do.public_url') . '/' . $filepath;

            $image = $this->image->create([
                'name' => $data
            ]);
            return $image->id;
        }
    }

    public function delete($id)
    {
        $image = $this->image->find($id);
        if (isset($image)) {
            $filepath = str_replace(config('filesystems.disks.do.public_url') . '/', '', $image);
            Storage::disk('do')->delete($filepath);

            $image->delete();
        }
    }
}
