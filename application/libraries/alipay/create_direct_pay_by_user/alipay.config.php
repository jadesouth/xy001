<?php
/* *
 * 配置文件
 * 版本：3.5
 * 日期：2016-06-25
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
 * 解决方法：
 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
 * 2、更换浏览器或电脑，重新登录查询。
 */
 
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://openhome.alipay.com/platform/keyManage.htm?keyType=partner
$alipay_config['partner'] = '2088621742262088';

//收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
$alipay_config['seller_id'] = $alipay_config['partner'];

//商户的私钥,此处填写原始私钥去头去尾，RSA公私钥生成：https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.nBDxfy&treeId=58&articleId=103242&docType=1
$alipay_config['private_key'] = '-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEA5AsRM2C+9YIDBA8ea7tYP5DxV+0Ext2Gdv9Fx6EzClcjVB8E
cHxZYVfNstOdfI0Ma1Oreo0xXuC3VSRrUc4+Jeztb08wZ7hxuidv6QTfDFrjFabB
RxKvNTY/Q7TmHQhiCqBNWA/cGIb43WoIj2RheHNxivbXTBGp30BMrxwPN3dtnhaw
ymsNqoHfthbbn/ZgXoX/PjygEP18yhH59sb+4OnaGdUKaXsEGnymk6RDpr/tURWB
urGI2eEf4swsOkER6A0UvPZMhTJGQ7//GNwFJi29xdH0x2vwKwCm5OF5pBtrToW6
EpwOwkMLk8TkW8hoEchZmyh50LB528iG3NQPuwIDAQABAoIBAQDd7ttlmiEeQ9J1
j9U2WZSQAJqwzI4akBs+Ej+yAfLvfFB4nNswMgS2lMIu6H3balYM2dgIJANJZ/9k
UFZVvheDx2poKrRcLQgZeCoUqFX+6zEXsDtn1QpJCitV1GcjGDZ6Svoa2wyDnk/z
BC+ihbnKhOeaq5JqiMI+8I/w16kDe1QGylFb59sG6+ygD65QAWHeZn+WKH1EFuqr
Ughvlr3lRh4S9vVfSDXvI4P3qgnZQJ88PQT3zGGxgr8iwKYE8P+1rdvUgEry2kdr
R8eny2AvizSFvCftLMuZ8CcLxt/syqShsvJzlSSG/n7ov2RKT8UCeNxDya8Bi8r7
vOorQ/QpAoGBAPYSLXRvpGksMLh9pIT8MoDAlYQV2niWdMaymrONlunht+EajIzf
pGY3S0fIRDjhywlB/ArwkicA+hAyXC9yYnRAE6ExhyFl8/UQLR5fyhCMFOihKydp
uIWVET/OrnvE/km5kIiqIGEl3g3xIl6MkLVs0RdxQcqcVbyrXE++eJSHAoGBAO0+
q10Kowl3xEwJ3bNIL1qSD68UrwcOsTkPEgR8oCjbVBNxgHsKeegZmvFwhCfU5rp7
NFGv855VrgcMtcZvuVFO5TQ7BtBFRMUrBQlmWt+BjjKr5EIDCB11dgX9oaXEc8k3
10EC69RZ1rI8fwNWDwmTr+95YJUUBD+6zwSMf2wtAoGBAMUf+MP/L9GFMh6JoINc
WcTlAqIGs7bIqRIIQIA4nD4OsbSmBRRRkKzF/QurNmPvFiz7bEMDR8HxOWJCRbFI
y/Be6JrIR32M5Ctc4xgjGoe5AIL/ocd4HPb+XQwlsYe7Xw6Glm+1Ai1xHXtDwgnG
R6LfYn2KIG+EX/a9vDyx1Hz/AoGBAIT/0QmD4Qp5ve3yyfqryQA5SdmY+tY2Alw+
epdRVmgRLP0JcEGKCfV4BUi9DxlVXVPFpfr1bNmipsEE+xKXp4hRdmTlglhXvMnb
6CLw4pjSBGmbu4bWNEJviw6otWo8y7xONboYbSTKiHW7PGkeYae4x7S0ktSAODGS
BGREb1qxAoGALF6rImsvjfHmeYlbvUMTaYOLpNqr3TBMF7XtV4l5v6KEU29zFJem
vNRNzuX/fGjU5hZnmY9CcVNgz50Zea3qcTjIwp3JvgmounDXy2TgCbKAHWQXoruZ
aq860gauHxD/dPsmxjd4SiNNZMjHDFQuKoD4CuA+Akn1gXd8rsKrXgE=
-----END RSA PRIVATE KEY-----
';

//支付宝的公钥，查看地址：https://b.alipay.com/order/pidAndKey.htm 
$alipay_config['alipay_public_key']= 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnxj/9qwVfgoUh/y2W89L6BkRAFljhNhgPdyPuBV64bfQNN1PjbCzkIM6qRdKBoLPXmKKMiFYnkd6rAoprih3/PrQEB/VsW8OoM8fxn67UDYuyBTqA23MML9q1+ilIZwBC2AQ2UBVOrFXfFl75p6/B5KsiNG9zpgmLCUYuLkxpLQIDAQAB';

// 升级订单
// 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
$alipay_config['notify_url'] = base_url('order/upgradePaymentZfbNotify');

// 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
$alipay_config['return_url'] = base_url('order/upgradePaymentZfbReturn');

// 首次下订单
// 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
$alipay_config['product_notify_url'] = base_url('order/productPaymentZfbNotify');

// 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
$alipay_config['product_return_url'] = base_url('order/productPaymentZfbReturn');

//签名方式
$alipay_config['sign_type'] = strtoupper('RSA');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset']= strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$alipay_config['cacert'] = getcwd().'\\cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport'] = 'http';

// 支付类型 ，无需修改
$alipay_config['payment_type'] = "1";

// 产品类型，无需修改
$alipay_config['service'] = "create_direct_pay_by_user";

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


//↓↓↓↓↓↓↓↓↓↓ 请在这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可 ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓

// 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
$alipay_config['anti_phishing_key'] = "";

// 客户端的IP地址 非局域网的外网IP地址，如：221.0.0.1
$alipay_config['exter_invoke_ip'] = "";

//↑↑↑↑↑↑↑↑↑↑请在这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可 ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
