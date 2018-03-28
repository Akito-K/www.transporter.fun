<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Aws\S3\S3Client;

class S3 extends Model {

    private $s3;
    private $config = [
/*
        'key' => 'AKIAJ4KLDRZ6IIMZQGAQ',
        'secret' => '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',
*/

        'credentials' => [
            'key' => 'AKIAJ4KLDRZ6IIMZQGAQ',
            'secret' => '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',
            ],

        'region' => 'ap-northeast-1',
        'version' => '2006-03-01',
        ];
    private $bucket = 'img.sjp-osaka-sandai-museum.com';

    function __construct(){
        $this->s3 = S3Client::factory($this->config);
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
