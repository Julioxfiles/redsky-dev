
## Where is it used:
## Donde se usa:

# Laravel 
1. Filesystem (Storage)
   * Unified API: `Storage`
   * Adapts: Local, S3, FTP/SFTP
2. Cache System
   * Unified API: `Cache`
   * Adapts: Redis, Memcached, File, Database
3. Database Drivers
   * Unified API: Query Builder / Eloquent
   * Adapts: MySQL, PostgreSQL, SQLite, SQL Server
4. Queue System
   * Unified API: `Queue` / `dispatch()`
   * Adapts: Redis, Database, SQS, Sync
5. Mail System
   * Unified API: `Mail`
   * Adapts: SMTP, Mailgun, SES, Sendmail
6. Notification Channels
   * Unified API: `Notification`
   * Adapts: Mail, SMS (Twilio), Slack, Database

