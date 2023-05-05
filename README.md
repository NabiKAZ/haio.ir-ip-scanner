# The scanner for the server IPs of HAIO.IR website.

## Description
Due to the severe censorship of the Internet in Iran, many IPs outside of Iran have been blocked. For pre-purchase review, the VPS Cloud sales [HAIO.IR](https://www.haio.ir/) website has done a good initiative and has provided the ping and SSH IP testing on your Internet.\
This script helps you scan all their IP servers and quickly find items that were not blocked.\
More information on their site: https://www.haio.ir/connection-test/

با توجه به سانسور شدید اینترنت در ایران، بسیاری از آی‌پی‌های خارج ایران مسدود شده‌اند. برای بررسی پیش از خرید، وب سایت فروش VPS کلود [HAIO.IR](https://www.haio.ir/) ابتکار خوبی انجام داده و قابلیت بررسی تست پینگ و SSH آی‌پی‌ها روی شبکه اینترنت شما را فراهم کرده است.\
این اسکریپت به شما کمک میکند تا تمام آی‌پی سرورهای آنها را اسکن کنید و به سرعت مواردی که مسدود نشدند را برای خرید پیدا کنید.\
اطلاعات بیشتر در سایت خودشان: https://www.haio.ir/connection-test/

## Usage
```
git clone https://github.com/NabiKAZ/haio.ir-ip-scanner
cd haio.ir-ip-scanner
php index.php
```

## Parameters
In a few starting lines, you can change a few variables:
```
$email = '<YOUR-USERNAME>';
$password = '<YOUR-PASSWORD>';
$country = 'All'; //All, France, Turkey, Canada, ...
```

## Sample Output
```
PS C:\Nabi\haio.ir-ip-scanner> php .\index.php 
Servers: France, IRAN, Turkey, Canada

> Country: France ... 164 items.
Host: 178.32.130.5:2280 ... CLOSED.
Host: 37.187.217.159:2280 ... CLOSED.
Host: 151.80.162.133:2280 ... CLOSED.
Host: 178.32.159.46:2280 ... CLOSED.
Host: 145.239.168.25:2280 ... CLOSED.
:
:
:
Host: 62.204.58.209:2280 ... CLOSED.
Host: 62.204.58.225:2280 ... CLOSED.
> Country: Canada ... 11 items.
Host: 192.99.253.143:2280 ... CLOSED.
Host: 198.50.131.232:2280 ... CLOSED.
Host: 198.50.131.224:2280 ... CLOSED.
Host: 198.50.131.226:2280 ... CLOSED.
Host: 158.69.6.54:2280 ... CLOSED.
Host: 158.69.6.57:2280 ... CLOSED.
Host: 192.99.253.135:2280 ... CLOSED.
Host: 192.99.253.132:2280 ... CLOSED.
Host: 158.69.6.61:2280 ... CLOSED.
Host: 192.99.253.131:2280 ... CLOSED.
Host: 192.99.253.128:2280 ... *** OPEN ***

ALL OKs:
151.80.242.237 (France)
37.187.217.146 (France)
192.99.253.128 (Canada)
```


## Donation
USDT (TRC20): `TEHjxGqu5Y2ExKBWzArBJEmrtzz3mgV5Hb`