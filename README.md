# DSi-Flipnote-Auth
My script for authentication with Flipnote Studio for the DSi.

If you wish to help with the to-do, please submit a PR with added name to the Credits section aswell as the code.

## Setup

To setup, you'll need the following:
* A working Flipnote Hatena server (please do not use Sudomemo, we have our own!)
* Ability to host the auth script in the proper location (/v2-eu/auth,/v2-us/auth,/v2-jp/auth - US and EU on flipnote.hatena.com, JP on ugomemo.hatena.ne.jp - set this via proxy or DNS)
* Apache 2.4+ with PHP 5

Simply copy the script to the correct location and ensure the script is accessible by the 3DS.

## To-do
* Add MySQL storage of tokens
* Add file-based storage of token (not logs) - SQLite?

### Credits
* PokeAcer for script
* jaames for helping me test Japanese Flipnote Studio

