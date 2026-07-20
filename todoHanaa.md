## v1

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


### algo
getSolde(idUser)
SELECT
COALESCE(
SUM(
CASE
WHEN type='credit' THEN montant
ELSE -montant
END
),0) as solde
FROM mouvement
WHERE id_user=?;

depot(user, montant)
crrer transaction, creer mouvement, type=credit, montant=montant

retrait(user, montant)
chercher bareme, frais =, total = montant+frais
solde = getSolde(user)
si solde < total erreur
sinon creer transaction creer mouvement debit montant = total


transfert(expediteur destinataire montant)
frais = calculFrais(operation montant)
total = montant+frais
solde = getSolde(expediteur)
si solde < total erreur
sinon 
creer transaction
mouvemet 1: expediteur debit montant = total
mouvemnt 2: destinataire credit montant = montant

calculFrais(operation, montant)

SELECT *

FROM bareme_frais

WHERE

operation=?

AND montant>=min

AND montant<=max

LIMIT 1

retourner montant_frais


historique
SELECT transaction operation date montant type
FROM mouvement
JOIN transaction
JOIN operation
WHERE id_user=?
ORDER BY date DESC



## v2
### algo
transfert
expediteur > recup son num > pour chaque destinataire | verifier qu'il existe, verifier mm operateur | > si u seul faux | erreur |  part = montant / nbDestinataires > calcul frais transfert(par part) > si priseEnChargeRetrait |ajouter frais retarit| > crrer transaction et blablabla > debit expediteur > credit de chaque destinataire > gain