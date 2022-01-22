<?php

use Illuminate\Support\Facades\Storage;

// ============================================================
if (!function_exists('get_lang')) {
    function get_lang() {
        return Request()->segment(1);
    }
}
// ============================================================

// ============================================================
if (!function_exists('change_language')) {
    function change_language( $lang ) {
        return  LaravelLocalization::getLocalizedURL( $lang );
    }
}
// ============================================================

// ============================================================
if (!function_exists('l_url')) {
    function l_url( $url ) {
        return LaravelLocalization::setLocale().'/'.$url;;
    }
}
// ============================================================

// ============================================================
if (!function_exists('site_text')) {
    function site_text($id) {
        $site = \App\Models\SiteText::where('id', $id );
        if ( $site->count() > 0)
        {
            return $site->first();
        }
        return 0;
    }
}
// ============================================================

// ============================================================
if (!function_exists('GetDayName')) {
    function GetDayName($date) {
        $nameOfDay = date('D', strtotime($date));
        return strtoupper($nameOfDay);
    }
}
// ============================================================

// ============================================================
if (!function_exists('random_code')) {
    function random_code($length = 10) {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = "" ;
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, strlen($alphabet)-1);
            $pass .= $alphabet[$n];
        }
        return $pass;
    }
}
// ============================================================

// ============================================================
if (!function_exists('create_qr_code')) {
    function create_qr_code($id,$folder_id) {
        $code = $folder_id. "-".$id ."-". random_code(5) ;
        $qrcode = \QrCode::format('png')->size(200)->errorCorrection('H')->generate($code);
        $output_file = '/qr-code/' . $folder_id . '/img-' . time() . '.png';
        Storage::disk('local')->put($output_file, $qrcode);
        //public/storage/qr-code/img-2222333.png
        return ["code"=>$code,"image"=>$output_file];
    }
}
// ============================================================

// ============================================================
if (!function_exists('right_redirect')) {
    function right_redirect($url) {

//            function startsWith ($string, $startString)
//            {
        $len = strlen('h');
//                return (substr($url, 0, $len) === 'h');
//            }

        if ( substr($url, 0, $len) === 'h' )
        {
            return $url;
        }

        return '#';
    }

}
// ============================================================

// ============================================================
if (!function_exists('setting')) {
    function setting() {
        return \App\Models\Setting::orderBy('id', 'desc')->first();
    }
}
// ============================================================

// ============================================================
if (!function_exists('GetImg')) {
    function GetImg( $img_src ) {
        if (filter_var($img_src, FILTER_VALIDATE_URL)) {
            $img = $img_src;
        } else if ( Storage::exists( $img_src ) ) {
            $img = url('storage/') . '/' . $img_src;
        } else {
            $img = url('/') . '/empty.png';
        }
        return $img;
    }
}
// ============================================================

// ============================================================
if (!function_exists('upload_image')) {
    function upload_image($path_='', $img, $plus, $file_name='', $delete_file=''){
        // delete old file
        $delete_file != '' ? Storage::delete($delete_file) : '';
        $path = $img->store($path_);
        return $path;
    }
}
// ============================================================

// ============================================================
if (!function_exists('delete_image')) {
    function delete_image($img){
        // delete old file
        $img!='' ? Storage::delete($img) : '';
    }
}
// ============================================================

// ============================================================
if (!function_exists('upload_multi_images')) {
    function upload_multi_images($image='', $id = '', $path = ''){

        $data['size']      = $image->getSize();
        $data['mime_type'] = $image->getMimeType();
        $data['name']      = $image->getClientOriginalName();
        $data['hashname']  = $image->hashName();
        $image->store( $path );
        return  $data;


    }

}
// ============================================================

// ============================================================
if (!function_exists('up')) {
    function up() {
        return new \App\Http\Controllers\Upload;
    }
}
// ============================================================

// ============================================================
if (!function_exists('aurl')) {
    function aurl($url = null) {
        return url('admin/'.$url);
    }
}
// ============================================================

// ============================================================
if (!function_exists('admin')) {
    function admin() {
        return auth()->guard('admin');
    }
}
// ============================================================

// ============================================================
if (!function_exists('active_menu')) {
    function active_menu($link) {
        if (preg_match('/'.$link.'/i', Request::segment(2) )) {
            return ['m-menu__item--open', 'display:block'];
        } else {
            return ['', ''];
        }
    }
}
// ============================================================

// ============================================================
if (!function_exists('datatable_lang')) {
    function datatable_lang() {
        return ['sProcessing'  => trans('admin.sProcessing'),
            'sLengthMenu'        => trans('admin.sLengthMenu'),
            'sZeroRecords'       => trans('admin.sZeroRecords'),
            'sEmptyTable'        => trans('admin.sEmptyTable'),
            'sInfo'              => trans('admin.sInfo'),
            'sInfoEmpty'         => trans('admin.sInfoEmpty'),
            'sInfoFiltered'      => trans('admin.sInfoFiltered'),
            'sInfoPostFix'       => trans('admin.sInfoPostFix'),
            'sSearch'            => trans('admin.sSearch'),
            'sUrl'               => trans('admin.sUrl'),
            'sInfoThousands'     => trans('admin.sInfoThousands'),
            'sLoadingRecords'    => trans('admin.sLoadingRecords'),
            'oPaginate'          => [
                'sFirst'           => trans('admin.sFirst'),
                'sLast'            => trans('admin.sLast'),
                'sNext'            => trans('admin.sNext'),
                'sPrevious'        => trans('admin.sPrevious'),
            ],
            'oAria'            => [
                'sSortAscending'  => trans('admin.sSortAscending'),
                'sSortDescending' => trans('admin.sSortDescending'),
            ],
        ];
    }
}
// ============================================================

// ============================================================
if (!function_exists('v_image')) {
    function v_image($ext = null) {
        if ($ext === null) {
            return 'image|mimes:jpg,jpeg,png,gif,bmp';
        } else {
            return 'image|mimes:'.$ext;
        }
    }
}
// ============================================================

// ============================================================
if (!function_exists('get_file')) {
    function get_file($file) {
        if (!is_null($file))
            return asset('storage').'/'.$file;
        else
            return asset('empty.png');

    }
}
// ============================================================
