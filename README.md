# GeoIPFlags

Adds a column in Dashboard/Users with the GeoIP country flag for the Last IP Address of each user.

Modification of the existing plugin to fix several issues:  

- Fixes paths for case sensitive filesystems.  
- Empty flag image for users with no Last IP  
- Table header only output for users with no name (now skips Akismet plugin)  
- Uses GEOIP_MEMORY_CACHE for speed  
- Closes filehandle after geoip_open
- PNG images have been optimised
- Updated world flags images

## Changelog
1.1, modification of the existing plugin to fix several issues  
1.0, initial release by vbgamer45  

## Details
See [http://vanillaforums.org/addon/895/geoipflags](http://vanillaforums.org/addon/895/geoipflags)

## Installation
Place the unzipped plugin folder in your `vanilla/plugins` folder and then activate using the Dashboard.  

## Updating
Keep your installation up-to-date with the following files:  
GeoIP.dat: [http://geolite.maxmind.com/download/geoip/database/GeoLiteCountry/GeoIP.dat.gz](http://geolite.maxmind.com/download/geoip/database/GeoLiteCountry/GeoIP.dat.gz)  
Large Flags: [http://flags.blogpotato.de/zip/large/world.zip](http://flags.blogpotato.de/zip/large/world.zip)  

### License
This plugin is made available under a [Creative Commons Attribution-Share Alike 3.0 Unported License](http://creativecommons.org/licenses/by-sa/3.0).

### Credits
Created by [vbgamer45](http://vanillaforums.org/profile/37130/vbgamer45), modified by Matt Sephton, [http://www.gingerbeardman.com/vanilla/](http://www.gingerbeardman.com/vanilla/)
