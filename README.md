# Shop Platform

## Installatie met Docker

Voor het installeren van het project met een Docker moeten de volgende commando's gebruikt worden.

```sh
docker build -t shop .
docker run -p "8080:80" -v ${PWD}/codeigniter:/app -v ${PWD}/mysql:/var/lib/mysql shop
```

Als het lukt met mijn sql folder -> ww: 98z4bIqnI2tv
Anders runnen en ww zelf ergens opslaan.

## Database bouwen

Voor het bouwen van de tables is er voorzien van een sql bestand. Voer deze query uit en alles is ready to go.
"# 03-Zalando-inspired-basic-website" 
