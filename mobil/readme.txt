angular (a megny�t�s�hoz v�gezze el a laravel l�p�seit is)
	cmd
	cd Mobil
	npm install
	ng serve 

laravel
	cmd
	cd API
	composer install
	.env.eample �tnevez�se .env -re
	.env m�dostani "DB_DATABASE=laravel"-t "e-com"-ra 
	Ha m�g nem import�rlta be e-com.sql akkor:
		ind�tson egy xamppot
		localhost/phpmadmin
		hozzon l�tre egy e-com n�ven databased
		majd import�lja be a filet
	php artisan key:generate
	php artisan serve