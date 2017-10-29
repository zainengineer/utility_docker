* clone the repo in util folder of your project
* in your `docker-compose.yml` add util as shown in this readme
* use commands like `./util/util.sh ssh nginx`
* for ip list `./util/util.sh ip_list`
## Docker Compose

    util:
        build:
              dockerfile: ./util/build/Dockerfile
              context: .
        environment:
            PHP_IDE_CONFIG: "serverName=docker.util"
        links:
           - nodejs:super-market.dev
        volumes:
          - ./util/app/cli:/cli_app
          - ./util/app/web/pub:/var/www/html