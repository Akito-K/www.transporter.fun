<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Aws\S3\S3Client;

class S3 extends Model {

    private $s3;
    private $config = [
        'credentials' => [
            'key' => 'AKIAICOYQOQXVWSPTLMQ',
            'secret' => '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',
            ],

        'region' => 'ap-northeast-1',
        'version' => '2006-03-01',
        ];
    private $bucket = 's3.transporter.fun';

    function __construct(){
        $this->s3 = S3Client::factory($this->config);
    }

    public function getBucket(){
        return $this->bucket;
    }

    public function Put($keyname, $filepath){
        $result = $this->s3->putObject([
            'Bucket' => $this->bucket,
            'Key' => $keyname,
            'SourceFile' => $filepath,
//            'ACL' => 'public-read',
            ]);
    }

    /**
     * @return [str, str...]
     */
    public function getDirectories(){
        $result = $this->s3->listObjects([
            'Bucket' => $this->bucket,
            'Delimiter' => '/',
            'Prefix' => 'img/photo/',
            ]);

        return $result;
    }

    public function Get($keyname, $to_savepath){
        $result = $this->s3->getObject([
            'Bucket' => $this->bucket,
            'Key' => $keyname,
            'SaveAs' => $to_savepath,
            ]);
    }



}
