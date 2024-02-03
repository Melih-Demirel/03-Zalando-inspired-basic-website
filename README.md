# eCommerce website using Codeigniter framework, Docker en MySql
## Installation

Run following commands:

```sh
docker build -t shop .
docker run -p "8080:80" -v ${PWD}/codeigniter:/app -v ${PWD}/mysql:/var/lib/mysql shop
```

## First run: Fill Database.

Execute 'shop.sql' to create all tables + fill them with data.
