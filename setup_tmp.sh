rm -R tmp
mkdir tmp
chown www-data:www-data tmp
chown www-data:www-data tmp/*
chmod 0770 tmp
chmod g+s tmp
chmod +t tmp
rm -- 'tmp/-:.html'

