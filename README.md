# M2-core-checker
The module scans the Magento2 core (files), creates a checksum for each file and writes a path_to_file => checksum to the database table.

Implemented the ability to exclude unnecessary directories from scanning.

In the same module, an external access point was created using REST API (it is planned to divide the module into two parts, one of which should work on the company's internal server, and the second part on the client's server)

Two cron jobs were created, the first one scans the magento core on the server and writes checksums to the database. The second one scans the magento client's core and compares the files using cURL and REST API.

Cron jobs has the ability to configure in the admin panel on the tab Stores/Configuration (start time, on / off, frequency).
