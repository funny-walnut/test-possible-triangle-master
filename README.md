# Test possible triangle

Example project for testing https://possible-triangle.herokuapp.com website
for Volga-IT digital olympiad.

## Project structure, shortly :
```tests/api``` - contains API tests

```tests/_support``` - directory for support code

```tests/_support/Step``` - step objects. 
Contain classes that we map to endpoint path and perform requests to endpoints

## How to start:
1. ```git clone git@github.com:barsukov2/test-possible-triangle.git```
or download it
2. ```cd test-possible-triangle```
2. Up containers ```make dup```
3. Install dependencies ```make install```

[![asciicast](https://asciinema.org/a/418917.svg)](https://asciinema.org/a/418917)

## How to run test:
```make run cest=path/to/your/cest/here```

for example, 

```make run cest=tests/api/GetTesterHiCest.php```

[![asciicast](https://asciinema.org/a/418918.svg)](https://asciinema.org/a/418918)

## Useful links
https://codeception.com/docs/02-GettingStarted

https://codeception.com/docs/07-AdvancedUsage

