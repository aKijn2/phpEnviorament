# MARKATZEKO LENGOAIA

## Egin - Erabiltzaileen Erregistro Sistema

Proiektu honek erabiltzaileen erregistro sistema bat inplementatzen du, MySQL datu-basean erabiltzaile berriak sortzeko aukera ematen duena. Sistema erabilatzeko, erabiltzaileak erabiltzaile-izena eta pasahitza baliogarriak eman beharko ditu. Garrantzitsua da soilik "aktiboa" egoerako erabiltzaileek sistema erabil dezakete.

### Erabilitako softwarea

- [Docker](https://www.docker.com/)

### Ingurunearen Konfigurazioa

1. Klonatu proiektu hau:

    ```bash
    git clone https://github.com/aKijn2/phpEnviorament.git
    ```

2. Ibilbidean sartu proiektuaren direktorioan:

    ```bash
    cd phpEnviorament
    ```

3. Docker Compose erabiliz kontainerrak abiatu:

    ```bash
    docker-compose up -d
    ```

### Sistema Erabilera

1. Sartu hasiera orrira:

    ```
    http://localhost
    ```

2. Betetzeko erabiltzaile erregistroaren formularioa erabili, erabiltzaile-izena, pasahitza, izena, abizena eta helbide elektronikoa eman.

3. Ziurtatu erabiltzaile berria aktiboa dela eta erregistro prozesuaren aurretik automatikoki aktibo gisa markatua izan dela.

### Teknikako Xehetasunak

Sistema hau Docker Compose erabiliz konfiguratzen da:

- Nginx: Erabiltzaileen interfazearen web zerbitzaria.
- PHPMyAdmin: MySQL datu-basearen kudeaketa tresna.
- MySQL: Erabiltzaileen informazioa gordetzeko datu-basea.
