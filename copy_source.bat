pscp  -i a:\misc\avi.pvt.ppk  avi@geulah.org.il:/var/www/hatanach/verse/* .
mkdir setup
pscp  -r -i a:\misc\avi.pvt.ppk  avi@geulah.org.il:/var/www/hatanach/verse/setup/* setup/.
mkdir script
pscp  -i a:\misc\avi.pvt.ppk  avi@geulah.org.il:/var/www/hatanach/verse/script/* script/.
mkdir css
pscp  -i a:\misc\avi.pvt.ppk  avi@geulah.org.il:/var/www/hatanach/css/* css/.
mkdir node_modules
pscp  -r -i a:\misc\avi.pvt.ppk  avi@geulah.org.il:/var/www/hatanach/verse/node_modules/* node_modules/.
pscp  -i a:\misc\avi.pvt.ppk  avi@geulah.org.il:/var/www/db_backup/verses.sql setup/.

c:\Users\avi\GitHub>move Hatanach_with_tools\css

echo USE verses; >> verses.sql
mysql -u root < verses.sql