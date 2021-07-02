cd ..
php index.php migrate
php index.php migrate seed
cd developer_tools
cd dump_sql
psql -U postgres cgdms < all.sql
cd ..
cd ..
php index.php utility generate_json