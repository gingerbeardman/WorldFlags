# GeoIPFlags

Adds a column in Dashboard/Users that has the GeoIP country flag of the last IP Address of the user.

Modification of the existing plugin to fix several bugs:  

- Fixes paths for case sensitive filesystems.  
- Empty flag image for users with no Last IP  
- Table header only output for users with no name (now skips Akismet plugin)  
- Uses GEOIP_MEMORY_CACHE for speed  
- Closes filehandle after geoip_open
- PNG images have been optimised

## Changelog
1.1, modification of the existing plugin to fix several bugs  
1.0, initial release by vbgamer45  

## Details
See [http://vanillaforums.org/addon/895/geoipflags](http://vanillaforums.org/addon/895/geoipflags)

## Installation
Place the unzipped plugin folder in your `vanilla/plugins` folder and then activate using the Dashboard.  

### License
This plugin is made available under a [Creative Commons Attribution-Share Alike 3.0 Unported License](http://creativecommons.org/licenses/by-sa/3.0).

### Credits
Created by [vbgamer45](http://vanillaforums.org/profile/37130/vbgamer45), modified by Matt Sephton, [http://www.gingerbeardman.com/vanilla/](http://www.gingerbeardman.com/vanilla/)
