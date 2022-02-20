# divido-config-chg
coding challenge

![image](https://user-images.githubusercontent.com/39347702/154834367-1289eb32-e6cb-463d-8fea-915761582ecf.png)

![image](https://user-images.githubusercontent.com/39347702/154834682-3c5b9ed9-d427-4078-a5a1-6b1c57cb7a7d.png)

The list of config files is set in **$config_files**. 

The required config values can be accessed via **$config->getConfig('environment')**.

I have added a **Dockerfile** to the project to make it easy.

To run the tests, use below docker commands from inside the **src** directory.

docker build -t divido-config-chg .

docker run -it divido-config-chg
