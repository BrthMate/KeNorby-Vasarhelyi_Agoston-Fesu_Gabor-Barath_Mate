angular (a megnyításához végezze el a laravel lépéseit is)
	cmd
	cd Mobil
	npm install
	ng serve 

laravel
	cmd
	cd API
	composer install
	.env.eample átnevezése .env -re
	.env módostani "DB_DATABASE=laravel"-t "e-com"-ra 
	Ha még nem importárlta be e-com.sql akkor:
		indítson egy xamppot
		localhost/phpmadmin
		hozzon létre egy e-com néven databased
		majd importálja be a filet
	php artisan key:generate
	php artisan serve