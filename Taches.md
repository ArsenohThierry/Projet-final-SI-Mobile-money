# PROJET FINAL SI ETU004031-ETU004273

<<<<<<< Updated upstream
## Taches : 

### Hanaa-4273:

### conception base
- user: id numero  role
- operation: id libelle(depot retrait transfert)
- transaction: id id_operation montant date
- mouvement: id id_transaction id_user type(credit debit) montant
- bareme_frais: id min max id_operation montant

### logique
- depot: solde += montant
- retrait: solde -= montant
- transfert: solde-= montant (expediteur) solde+=montant (destinataire)

transfert: 2 lignes dans mouvement de mm id_transaction (1 debit 1 credit)

solde = somme(credit) - somme(debit)

FRAIS:
>>>>>>>
bareme frais retrait et transfert tsy mitovy
le systeme doit calculer automatiquement le frais a partir du montant de la table bareme_frais

### Arsenoh-4031 :

CRUD = CRUD + Liste flitrable

- [ok]Login (cote client et operateur):
    - [ok]Si operateur : email et mdp
    - [ok]Si client : par numero 
        - [ok]SI existe : login direct
        - [ok]SI pas encore : Page d'insertion Nom 
- [ok]CRUD DES PREFIXES ( 033 , 037)
- [ok]CRUD de types d'operations ( Depot , Retrait , Transfert)
- [ok]CRUD DES FRAIS  : ajouter des frais pour chaque type d'operation
- [ok]Dashboard avec un card qui affiche le gain : (total des frais)
- [ok]CRUD des cleints:
    - [ok]Detail d'un client quand on clique dessus : (Nom, numero , solde , date creation)
- [ok]Ajoute de CSS et design :
=======

## V1 : 
### Initialisation du projet : 
- Création du dépôt github (2 min)
- Lecture et comprehension du projet ( 20 min)
- Conception base
>>>>>>> Stashed changes
