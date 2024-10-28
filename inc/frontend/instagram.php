<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" );
class InstaWCD{
    function userID(){
        $username = strtolower($this->username); // sanitization
        $token = $this->access_token;
        $user_id = $this->user_id;
    }

    function get_remote_data_from_instagram_in_json($url){
        $content = wp_remote_get( $url );
        if(isset($content->errors)){
            $content = json_encode(array('meta'=>array('error_message'=>$content->errors['http_request_failed']['0'])));
            $content = json_decode($content, true);
            return $content;
        }else{
            $response = wp_remote_retrieve_body( $content );
            $json = json_decode( $response, true );
            return $json;
        }
    }

    /**
     * get the user media
     * @return json
     */
    function userMedia(){
        $token = $this->access_token;
        $user_id = $this->user_id;
        $url = 'https://graph.instagram.com/'.$user_id.'/media?fields=id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username&access_token=' . $token .'';
        $json = self::get_remote_data_from_instagram_in_json( $url );
        return $json;
    }

    //retrive user info
    function userInfo(){
        $token = $this->access_token;
        $user_id = $this->user_id;
        $url = 'https://graph.instagram.com/'.$user_id.'?fields=id,username,media_count,account_type&access_token=' . $token .'';
        $json = self:: get_remote_data_from_instagram_in_json( $url );
        //print_r($json);
        return $json;
    }
}
$insta = new InstaWCD();
$insta->username = $username;
$insta->access_token = $access_token;
$insta->user_id=$user_id;
