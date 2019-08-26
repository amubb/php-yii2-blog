安装
=
- 命令行执行 composer install
- 命令行执行 php init, 选择 [1] Production 安装，接下来全部选 yes
- 新建数据库并导入 common/data/blog_amubb_com.sql，配置 common/config/main-local.php （参考common/config/main-local.tpl.php）
- 服务器配置（参考/docs/apache.conf /docs/nginx.conf）
- 后台访问路径为 /admin.php 初始账号 admin 初始密码 123456