<?php

namespace App\Helper;

use Intervention\Image\Laravel\Facades\Image;

class FileUpload
{

    public static function imageUpload($image, $imageDirectory, $imageNameString = null, $width = null, $height = null, $oldFileUrl = null)
    {

        if ($image)
        {
//            return 'sarowar image';
            if (file_exists($oldFileUrl))
            {
                unlink(public_path($oldFileUrl));
            }
            $imageName = (isset($imageNameString) ? $imageNameString : '').'-'.time().rand(10,1000).'.'.$image->getClientOriginalExtension();
            $imageUrl = $imageDirectory.$imageName;
//            if ($image->getClientOriginalExtension() == 'ico')
//            {
                $image->move($imageDirectory, $imageName);
//            } else {

//                $images = Image::make($image)->resize((isset($width) ? $width : ''), (isset($height) ? $height : ''))->encode('webp',65)->save($imageUrl,65);


//            $prefix = '';
//            $config = [
//                'key' => '7NBPYLX5IMJMXEVUAMJR',
//                'secret' => 'k8PDyRPK94ZXjtoZExxCqqEXD8HI4jN63qCtJW0Z',
//                'bucket' => 'biddabari-bucket',
//                'endpoint' => 'obs.as-south-208.rcloud.reddotdigitalit.com',
//            ];
//
//            $config['options'] = [
//                'url' => '',
//                'endpoint' => $config['endpoint'],
//                'bucket_endpoint' => 'https://biddabari-bucket.obs.as-south-208.rcloud.reddotdigitalit.com',
//                'temporary_url' => '',
//            ];

//            $client = new ObsClient($config);
//            $adapter = new ObsAdapter($client, $config['bucket'], $prefix, null, null, $config['options']);
//            $flysystem = new Filesystem($adapter);
//
//            $result = $client->putObject([
//                'Bucket' => env('OBS_BUCKET'),
//                'Key' => $imageUrl,
//                'SourceFile' => $imageUrl,
//                ]);

//                if (file_exists($imageUrl))
//                {
//                    unlink(public_path($imageUrl));
//                }
//            }
        } else {
            $imageUrl = $oldFileUrl;
        }
        return $imageUrl;
    }

}
