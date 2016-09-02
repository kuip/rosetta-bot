# Convert SNOMED-CT data into Subject.ro structure

## We use

- MySQL
- PHP
- MongoDB

## Current workflow

- make sure your `php.ini` file lets you upload big files. Restart server.

```
memory_limit=12800M
post_max_size=12800M
upload_max_size=9280M
```

- We take the `Snapshot` `txt` files and put them in MySQL (`\t` separated `csv`).
