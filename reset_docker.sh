echo "Parando dockers"
docker ps -a | grep "tecnofit" | awk '{print $1}' | xargs docker stop
echo "Excluindo dockers"
docker ps -a | grep "tecnofit" | awk '{print $1}' | xargs docker rm
echo "Excluindo volume"
docker volume rm tecnofit3_persistent
echo "Excluindo containers"
docker images | awk '{print $1}' | xargs docker rmi
