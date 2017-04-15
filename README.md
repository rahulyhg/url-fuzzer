# url-fuzzer
Simple hidden directory finder in PHP
## Usage

~~~
$ php fuzzer.php
Usage: php fuzzer.php <url> <list> [hide]...

Parameters:
  url               Url to fuzz
  list              File containing the list of directories to search
  hide (Optional)   HTTP codes to hide in results, default is 404
~~~

List.txt ripped from [here](https://pentest-tools.com/website-vulnerability-scanning/discover-hidden-directories-and-files)
