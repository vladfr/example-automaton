# example-automaton

## Docker run
1. Get [boot2docker](http://boot2docker.io)
2. [Install fig](http://fig.sh)
3. Use it!
```
> $(boot2docker shellinit)
> fig up
> docker exec -ti exampleautomaton_php_1 composer install && composer dumpautoload
> docker exec -ti exampleautomaton_php_1 php -S 0.0.0.0:80
```

## REST Api example

http://192.168.59.103/index.php/image/index    
No auth, missing transition

http://192.168.59.103/index.php/image/index?user=vlad    
Implemented, will return 200

http://192.168.59.103/index.php/image/none?user=vlad    
Not implemented, 404 Not found

http://192.168.59.103/index.php/image/fail?user=vlad    
Fails, Error 500