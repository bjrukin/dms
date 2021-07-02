#!bin/bash
logfile="/var/www/html/cgdms/application/logs/db.log"
backup_dir="/var/www/html/cgdms/dbbackup"
dateinfo=`date '+%Y-%m-%d %H:%M:%S'`
timeslot=`date '+%Y%m%d%H%M'`

echo "Backup Process Started" > $logfile
/usr/bin/pg_dump -U postgres --no-password --ignore-version --file=$backup_dir/cgdms_$timeslot.sql.gz --compress=9 cgdms
echo "Backup Process Completed $dateinfo for database: cgdms " >> $logfile

