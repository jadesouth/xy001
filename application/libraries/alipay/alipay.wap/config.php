<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2017042506958334",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDRcWo9WiYjC0sh
MxPD2S/TNPGRS88oi35sSOzcN0sphNDdbpDsAI8IlwBINOIAvibbYL7WO3KRukn5
r7Ldo1nJJv8Z1LHsjEzJBAqPcRLRTKw3CKiZF8e1Q6/qHNZqb1z2s23E05GxfRkb
pow4wAKBbZc/42AC6WGi9aXwoukhvCFgPAex4rJcbMJpV+V4Ivn99tRiJjBRqgWF
ELrrLLIMN1nHIg3Gsjt2yvWSCyFvv9YHz1x/r9zFNIx6Ju5AkZX+/mWry65HfmDc
V05bthbN5zyM0gVO/P7wHAAby0CD1eGka0diSg915r/8MsST/7PU4okb/fLvn4Oo
b2LtpVBPAgMBAAECggEAMIp9meyLzDFw3yfsW8a5W9T4a7lLMNVrnoMkSkGSbPP4
SGm4ssnKXK5KhXGkM5HehZedgx9SBU5MmM7MwKt8Qq+EDiOKfQ1jOm9yVx5YwyNn
AnZCRQEK6wrd+X9nflGDFTYuqaBzMtSQfiUSeJCfxAl3NXpoJSSb2V3fcK8BIy0A
T4QOxiSJnDM7kwsBLp7jl1YzxebhvQxjvZ6GUrd5BbsG7PSChlCdg+ORGUtGMeQO
QlwsHC+68MaLMA+39B2zVAsooUtTY/seY19C1KbuPx7ZLlLm0b2xpjBZtHVO1g/Q
bKrwxDls3ta2kXapLfPeVdOEzqoUQUgDMZVZNgNn4QKBgQD6rbbZLCvmyUHhSXlx
nKYSXPK+IEXHAZUdNW/5rQ8ILGzHrCtw3j9UFhS44/rgvnmhDwdyX4+0Bmtfaw9q
D7eUcRNcvcO9AvK8n2MCkl+IWHfLTgaXd6hjygEDKSwbH7wP9mOJfI4VrQxtbhHB
xsFi98Ld3lcnzMbuxqMYa7Mg0QKBgQDV45xRW1ZKqSXtkz5meztWhsb8/bCeXxAf
2Ift76mb90kNG7s11H2xhRCxvEPvxa46qVst9UA/Y4/sLTH6NRrNqg58J7C6DEKn
/QPVEPTArwZeGI0D4lg0z751sfflVqPhnaiXiMNBU58OTyP7uryRDNLnW2a7TclJ
Zf54QsynHwKBgC+l31COVdXrQUt6NMxEk0iARF+hMMIv6dEAfEVAANBz6UVW03cD
t5PbEptGMkSPz/yuJ6M0yNLWOYiMiASH8kQT7jM9mrwNmGgD/8TYX7JB5ptNPHGD
/Azjs6ePJuQM9yktkyPp+fPiza7rMhLcHZwbLf4QKg7VnKZ8OToGFqlRAoGAG+XI
KcRkCPDvBYHDDdLc9ng11CGyu7VigQTZFevAj5s9Z/xJ+sdwbYsRll0b71Y1V2ln
fyMR8jKmPwPWFPCAQnr/0KnMnzeiKg8SROQlSEyL5BIHso3/O0Qtb2R7FOqsDW1m
4/zumsKxaEhiRR8iITku+QYu7BdFPdGT01PDJbkCgYEA7Agz040RoD/zT2ciicvY
eRoE0y3HJ5Oiv3ttD+FH7gXS5HRLk6m1xL6j+MBstpzTCzaqcfapUUvelhRlhU12
U6EZGOfde/JwX2ijTtlGvGcc1hoePGroImPgNZLtDahGdOobWi5SGLtS2v+RA3HU
by0tW3+msWYyKzyUBVb5QIk=
-----END PRIVATE KEY-----",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmC4I8dc4he2LPTO5Ku66F6+RCZVi5qv5/no0c/7bEaGn//PPV1frg9wbXi1yUmkoRJb05ORj/UoMhPvmjrklZxmBSSI3if0fPPQXGWMZ50/EEFpouAT9ohYx+75RckQolJIt9t8nYRuT0B3r6Vn7ShBJZcR4FmU5IMzSjOI4iWWqMnQtQV3O8UMBLzTlfVzR0CuobZMt4NIW8Cel/lG+/JTHKYyYm4k2zUcsRnJvTtxlRqabe5nWK5ERE6zB2oROf3DbFrHRPU/m5Va67693ARCtv4YQ7vEC4+QlNplnxrs0qCcqSGptKArU/0D4Yjk8lv+OLjIRppCoIVtlcO82IQIDAQAB",
		
	
);