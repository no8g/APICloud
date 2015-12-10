<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/** 
 * @author fanz
 * @version 1.0 
 * @created 
 */  
   
class Rsa  
{  
    private static $PRIVATE_KEY = '-----BEGIN PRIVATE KEY-----  
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAM9nUm7rPNhSgvsd  
jMuCd5E7IMJB/80A1YY7jYV9fBCKdhVKmqea26QYuw6FW7B00fppEUTSazduSmn9  
Yvhx9UOCcI75b0nq9FWm5O4P+Kp8l31M1pwsJ3cm+DceGOrFsl47vh9idiqj+abI  
lJ4sTmJmDghmbks9YFlZSndQsIBlAgMBAAECgYAasa6vbgF3yi7niScc7l7bR2Pw  
/LOivA+/ZhzR6JO2QUvvc5myJsFMPo6c0Nc7P93iv/EkDX0VNlHHkIBTf79URHXM  
gXwMad4pHAeOiqxk5A9w/szDCBoETngtoqQGJq+QINxwPVvDEO4i224Uj3MKg2fo  
4SDy3P1GCAAj1ahNoQJBAP4FV9vLWdLOOwOLnBpXt6vru4HT5VIf9fCeBIemuQ4C  
/yRtgU38zXWgZ8AAmS6EjBEUDnN/tWid6UBKfgPDwAkCQQDRBP+Y9wIYIaSxeL7B  
nHhPT25yAJCGK+l6r2qeaHVQr81O9YjusEi8E2M5OxCRolKxC3L7hrLJX8z1oyOV  
dNx9AkBqYGhzpgv+qNiz2mJL8dH8ECMc8lTFeJbw5eu1tw8mHAEnCyisNSMBkGQC  
Vv3PKjjR6hlHKwMYRZDpmIh/IRmpAkEAr1soLGaeZSxkhVetgbUJ4k/bct0yYr4Y  
ZQshwcAVHBpBforT1JwkiVUim3MIFYY/JbVbQ9XfzL4Ir9OsGMkv6QJAPaQnyNY5  
/D0PhXqODOM6jtAHHRfaSi4gve6AZ0iRz6YlB8beJ1ywZaJZWD9Cuw3zy4dDpCOn  
A4tBsIdpMMoT+w==  
-----END PRIVATE KEY-----'; 
private static $PUBLIC_KEY = '-----BEGIN PUBLIC KEY-----  
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDPZ1Ju6zzYUoL7HYzLgneROyDC  
Qf/NANWGO42FfXwQinYVSpqnmtukGLsOhVuwdNH6aRFE0ms3bkpp/WL4cfVDgnCO  
+W9J6vRVpuTuD/iqfJd9TNacLCd3Jvg3HhjqxbJeO74fYnYqo/mmyJSeLE5iZg4I  
Zm5LPWBZWUp3ULCAZQIDAQAB  
-----END PUBLIC KEY-----'; 

    /** 
    *返回对应的私钥 
    */  
    private static function getPrivateKey(){  
      
        $privKey = self::$PRIVATE_KEY;  
           
        return openssl_pkey_get_private($privKey);        
    }  
    /** 
    *返回对应的公钥 
    */  
    private static function getPublicKey(){  
      
        $publKey = self::$PUBLIC_KEY;  
           
        return openssl_pkey_get_public($publKey);        
    }  
   
    /** 
     * 私钥加密 
     */  
    public static function privEncrypt($data)  
    {  
        if(!is_string($data)){  
                return null;  
        }             
        return openssl_private_encrypt($data,$encrypted,self::getPrivateKey())? base64_encode($encrypted) : null;  
    }  
      
      
    /** 
     * 私钥解密 
     */  
    public static function privDecrypt($encrypted)  
    {  
        if(!is_string($encrypted)){  
                return null;  
        }  
        return (openssl_private_decrypt(base64_decode($encrypted), $decrypted, self::getPrivateKey()))? $decrypted : null;  
    } 

    /** 
     * 公钥加密 
     */  
    public static function publEncrypt($data)  
    {  
        if(!is_string($data)){  
                return null;  
        }             
        return openssl_public_encrypt($data,$encrypted,self::getPublicKey())? base64_encode($encrypted) : null;  
    }  
      
      
    /** 
     * 公钥解密 
     */  
    public static function publDecrypt($encrypted)  
    {  
        if(!is_string($encrypted)){  
                return null;  
        }  
        return (openssl_public_decrypt(base64_decode($encrypted), $decrypted, self::getPublicKey()))? $decrypted : null;  
    } 


}  
   
?>  