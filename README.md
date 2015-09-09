# online-since

phpBB3.1 extension that shows the length of time your board has been online. in Years, Months and Days.

This is a port of the MOD I made first for phpBB2 and for phpBB3 (Olympus) then.

Build Status: [![Build Status](https://travis-ci.org/3D-I/online-since.svg)](https://travis-ci.org/3D-I/online-since)

![Screenshot](online-since.png)

## Installation

### 1. clone
Clone (or download and move) the repository into the folder ext/3D-I/online_since
(create it if not already exists):

```
cd phpBB3
git clone https://github.com/3D-I/online-since.git ext/3D-I/online_since/
```

### 2. activate
Go to admin panel -> tab Customise -> Manage extensions -> enable online_since

## Update instructions:
1. Go to you phpBB-Board > Admin Control Panel > Customise > Manage extensions > online_since: disable
2. Delete all files of the extension from ext/3D-I/online_since
3. Upload all the new files to the same locations
4. Go to you phpBB-Board > Admin Control Panel > Customise > Manage extensions > online_since: enable
5. Purge the board cache
