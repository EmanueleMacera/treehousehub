# 📸 Guida: Come Aggiungere Logo e Foto del Team

Il codice è già pronto per gestire logo e foto del team. Devi solo caricare le immagini nelle cartelle corrette.

## 🎨 Logo TreeHouse Italia

### Dove caricare il logo
Carica il logo nella seguente posizione:
```
public/images/logo-treehouse.png
```

### Specifiche raccomandate
- **Formato**: PNG con sfondo trasparente (preferibile) o JPG
- **Dimensioni**: Larghezza minima 200px, altezza minima 80px
- **Proporzioni**: Orizzontale (es. 200x80, 300x120, 400x160)
- **Peso**: Massimo 100KB per prestazioni ottimali

### Cosa succede
- Se il file esiste, il logo viene mostrato nella navbar
- Se il file non esiste, viene mostrato il testo "TreeHouse Italia"
- Il logo è responsive: 40px su desktop, 32px su mobile

---

## 👥 Foto Team Members

### Dove caricare le foto
Crea la cartella e carica le foto con questi nomi esatti:

```
public/images/team/carlo-pampirio.jpg
public/images/team/alessandro-pampirio.jpg
public/images/team/franco-riccardi.jpg
public/images/team/roberta-nattino.jpg
public/images/team/stefania-vigorita.jpg
```

### Specifiche raccomandate
- **Formato**: JPG o PNG
- **Dimensioni**: Quadrate 400x400px o 600x600px
- **Proporzioni**: 1:1 (quadrato perfetto)
- **Peso**: 50-200KB per foto
- **Stile**: Foto professionali con sfondo neutro

### Cosa succede
- Se la foto esiste, viene mostrata nella card del membro
- Se la foto non esiste, viene mostrato un placeholder emoji (👤)
- Le foto sono automaticamente ritagliate a cerchio con border-radius

---

## 🚀 Come Caricare i File

### Opzione 1: Via FTP/SSH
1. Connettiti al server
2. Naviga in `public/images/`
3. Crea la cartella `team` se non esiste
4. Carica `logo-treehouse.png` in `public/images/`
5. Carica le foto team in `public/images/team/`

### Opzione 2: Via Git (da locale)
```bash
# Crea la cartella
mkdir -p public/images/team

# Copia le immagini
cp /percorso/logo.png public/images/logo-treehouse.png
cp /percorso/carlo.jpg public/images/team/carlo-pampirio.jpg
# ... altre foto

# Commit e push
git add public/images/
git commit -m "ADD: logo e foto team"
git push origin master
```

### Opzione 3: Via cPanel/Pannello Hosting
1. Accedi al pannello di controllo
2. Vai in File Manager
3. Naviga in `public/images/`
4. Crea cartella `team`
5. Upload dei file nelle rispettive posizioni

---

## ✅ Verifica

Dopo aver caricato i file:

1. **Logo**: Vai sulla homepage e verifica che il logo appaia nella navbar al posto del testo
2. **Foto team**: Vai su `/it/chi-siamo` e verifica che le foto appaiano nelle card dei membri

---

## 🎨 Ottimizzazione Immagini (Opzionale)

Per prestazioni migliori, ottimizza le immagini prima di caricarle:

### Tools online gratuiti:
- **TinyPNG**: https://tinypng.com (PNG/JPG)
- **Squoosh**: https://squoosh.app (tutti i formati)
- **ImageOptim**: https://imageoptim.com (Mac)

### Comando da terminale (se hai ImageMagick):
```bash
# Ridimensiona logo
convert logo-originale.png -resize 400x160 -quality 85 public/images/logo-treehouse.png

# Ridimensiona foto team
convert foto-carlo.jpg -resize 600x600^ -gravity center -extent 600x600 -quality 80 public/images/team/carlo-pampirio.jpg
```

---

## ❓ Domande Frequenti

**Q: Posso usare formati diversi da PNG/JPG?**  
A: Sì, ma PNG e JPG sono raccomandati per compatibilità. SVG funziona ma potresti dover aggiustare gli stili CSS.

**Q: Le foto devono essere tutte delle stesse dimensioni?**  
A: No, il CSS le adatta automaticamente. Ma per qualità ottimale usa 400x400px o 600x600px quadrate.

**Q: Cosa succede se cambio il nome del file?**  
A: Devi aggiornare il codice in `resources/views/public/about.blade.php` e `resources/views/layouts/public.blade.php` con il nuovo nome.

**Q: Posso aggiungere più membri del team?**  
A: Sì, duplica una delle `<article class="team-member">` nella pagina about e aggiorna nome, ruolo e path foto.

---

## 📝 Note Tecniche

Il sistema usa `file_exists()` per verificare la presenza dei file:
- **Logo**: `file_exists(public_path('images/logo-treehouse.png'))`
- **Foto**: `file_exists(public_path('images/team/[nome].jpg'))`

Se vuoi cambiare i path, modifica i file blade appropriati.

---

**Ultimo aggiornamento**: 14 Gennaio 2026  
**Repository**: [treehousehub](https://github.com/EmanueleMacera/treehousehub)
