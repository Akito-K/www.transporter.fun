<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use softDeletes;
    protected $table = 'uploads';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'UPL-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($unique_id){
        $data = Upload::where('upload_id', $unique_id)->first();

        return $data;
    }


    /**
     * @param Request
     * @param str
     * @param str foo.jpg etc
     */
    public static function moveUploadFile($request, $dir, $filename){
        if(!file_exists($dir)){
            mkdir($dir);
        }

        $file = $request->file('file')->move($dir, $filename);
    }

    /**
     * @param string
     * @return int
     */
    public static function getResizeWidth($size){
        $width = ['lg' => 1280, 'md' => 640, 'sm' => 320];

        return $width[ $size ];
    }

    /**
     * @param object( width, from_url, from_fullpath, to_fullpath, ...)
     * from_url は使わない（負債）
     */
    public static function Resize($data){
//        $content = \Func::var_var_dump($data['from_fullpath']);
//        \Func::myFilePutContents($content, NULL, false);

        $image = \Image::make($data->from_fullpath);

        $image->resize($data->width, null, function($constraint){
            $constraint->aspectRatio();
        });

        $image->save($data->to_fullpath);
        unset($image);
    }

    public static function saveResizedImages($file, $s3, $return_size='md'){
        $return_keyname = "";
        // リサイズして tmp に保存、その後 S3 に rename
        $sizes = ['lg', 'md', 'sm'];
        foreach($sizes as $size){
            $new_keyname = Upload::saveResizedImage( $file, $s3, $size );
            if($return_size == $size){
                $return_keyname = $new_keyname;
            }
        }

        // 元ファイルを EC2 から S3 に rename
        Upload::Rename( $file, $s3 );

        return $return_keyname;
    }

    public static function Rename($file, $s3){
        $original_filepath = $file->dirpath.'/'.$file->upload_id.'.'.$file->extension;
        $root = \Func::getRootPath();
        $from_fullpath = $root.$original_filepath;
        $new_filename = $file->upload_id.'_original.'.$file->extension;

        $new_keyname = 'img/photo/'.date('Y').'/'.date('m').'/'.$new_filename;
        $s3->Put($new_keyname, $from_fullpath);
        // tmp の方を削除
        unlink($from_fullpath);
    }

    public static function RenameNotImageFile($file, $s3){
        $original_filepath = $file->dirpath.'/'.$file->upload_id.'.'.$file->extension;
        $root = \Func::getRootPath();
        $from_fullpath = $root.$original_filepath;
        $new_filename = sha1( $file->upload_id ).'.'.$file->extension;

        $new_keyname = 'files/'.date('Y').'/'.date('m').'/'.$new_filename;
        $s3->Put($new_keyname, $from_fullpath);
        // tmp の方を削除
        unlink($from_fullpath);

        return $new_keyname;
    }

    /**
     * @param object ( size, root, upload_id, extension, year, month)
     * @param S3 Object
     */
    public static function saveResizedImage($file, $s3, $size){
        $original_filepath = $file->dirpath.'/'.$file->upload_id.'.'.$file->extension;
        $new_filename = $file->upload_id.'_'.$size.'.'.$file->extension;
        $root = \Func::getRootPath();

        // リサイズしていったん tmp に保存
        $data = new \stdClass();
        $data->width = Upload::getResizeWidth( $size );
        $data->from_fullpath = $root.$original_filepath;
        $data->to_fullpath = $root.$file->dirpath.'/'.$new_filename;
        Upload::Resize( $data );

        // tmp から S3 にコピー
        $new_keyname = 'img/photo/'.date('Y').'/'.date('m').'/'.$new_filename;
        $s3->Put($new_keyname, $data->to_fullpath);

        // tmp の方を削除
        unlink($data->to_fullpath);

        return $new_keyname;
    }


}
