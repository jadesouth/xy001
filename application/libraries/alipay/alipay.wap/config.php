<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2017042506958334",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEA0XFqPVomIwtLITMTw9kv0zTxkUvPKIt+bEjs3DdLKYTQ3W6Q7ACPCJcASDTiAL4m22C+1jtykbpJ+a+y3aNZySb/GdSx7IxMyQQKj3ES0UysNwiomRfHtUOv6hzWam9c9rNtxNORsX0ZG6aMOMACgW2XP+NgAulhovWl8KLpIbwhYDwHseKyXGzCaVfleCL5/fbUYiYwUaoFhRC66yyyDDdZxyINxrI7dsr1kgshb7/WB89cf6/cxTSMeibuQJGV/v5lq8uuR35g3FdOW7YWzec8jNIFTvz+8BwAG8tAg9XhpGtHYkoPdea//DLEk/+z1OKJG/3y75+DqG9i7aVQTwIDAQABAoIBADCKfZnsi8wxcN8n7FvGuVvU+Gu5SzDVa56DJEpBkmzz+EhpuLLJylyuSoVxpDOR3oWXnYMfUgVOTJjOzMCrfEKvhA4jin0NYzpvclceWMMjZwJ2QkUBCusK3fl/Z35RgxU2LqmgczLUkH4lEniQn8QJdzV6aCUkm9ld33CvASMtAE+EDsYkiZwzO5MLAS6e45dWM8Xm4b0MY72ehlK3eQW7Buz0goZQnYPjkRlLRjHkDkJcLBwvuvDGizAPt/Qds1QLKKFLU2P7HmNfQtSm7j8e2S5S5tG9saYwWbR1TtYP0Gyq8MQ5bN7WtpF2qS3z3lXThM6qFEFIAzGVWTYDZ+ECgYEA+q222Swr5slB4Ul5cZymElzyviBFxwGVHTVv+a0PCCxsx6wrcN4/VBYUuOP64L55oQ8Hcl+PtAZrX2sPag+3lHETXL3DvQLyvJ9jApJfiFh3y04Gl3eoY8oBAyksGx+8D/ZjiXyOFa0MbW4RwcbBYvfC3d5XJ8zG7sajGGuzINECgYEA1eOcUVtWSqkl7ZM+Zns7VobG/P2wnl8QH9iH7e+pm/dJDRu7NdR9sYUQsbxD78WuOqlbLfVAP2OP7C0x+jUazaoOfCewugxCp/0D1RD0wK8GXhiNA+JYNM++dbH35Vaj4Z2ol4jDQVOfDk8j+7q8kQzS51tmu03JSWX+eELMpx8CgYAvpd9QjlXV60FLejTMRJNIgERfoTDCL+nRAHxFQADQc+lFVtN3A7eT2xKbRjJEj8/8riejNMjS1jmIjIgEh/JEE+4zPZq8DZhoA//E2F+yQeabTTxxg/wM47OnjybkDPcpLZMj6fnz4s2u6zIS3B2cGy3+ECoO1ZymfDk6BhapUQKBgBvlyCnEZAjw7wWBww3S3PZ4NdQhsru1YoEE2RXrwI+bPWf8SfrHcG2LEZZdG+9WNVdpZ38jEfIypj8D1hTwgEJ6/9CpzJ83oioPEkTkJUhMi+QSB7KN/ztELW9kexTqrA1tZuP87prCsWhIYkUfIiE5LvkGLuwXRT3Rk9NTwyW5AoGBAOwIM9ONEaA/809nIonL2HkaBNMtxyeTor97bQ/hR+4F0uR0S5OptcS+o/jAbLac0ws2qnH2qVFL3pYUZYVNdlOhGRjn3XvycF9oo07ZRrxnHNYaHjxq6CJj4DWS7Q2oRnTqG1ouUhi7Utr/kQNx1G8tLVt/prFmMis8lAVW+UCJ",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => base_url('order/productPaymentZfbReturn'),

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmC4I8dc4he2LPTO5Ku66F6+RCZVi5qv5/no0c/7bEaGn//PPV1frg9wbXi1yUmkoRJb05ORj/UoMhPvmjrklZxmBSSI3if0fPPQXGWMZ50/EEFpouAT9ohYx+75RckQolJIt9t8nYRuT0B3r6Vn7ShBJZcR4FmU5IMzSjOI4iWWqMnQtQV3O8UMBLzTlfVzR0CuobZMt4NIW8Cel/lG+/JTHKYyYm4k2zUcsRnJvTtxlRqabe5nWK5ERE6zB2oROf3DbFrHRPU/m5Va67693ARCtv4YQ7vEC4+QlNplnxrs0qCcqSGptKArU/0D4Yjk8lv+OLjIRppCoIVtlcO82IQIDAQAB",
		
	
);