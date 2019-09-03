# share_cheese

Fonctionnalités :

Blog
	Page d’articles
	CRUD → ROLE_EDITEUR → Entity Catégories [recettes, focus sur fromages, focus sur producteur...]

User
	Page compte
	
	Voir mes annonces
	Voir mes échanges terminés
	Créer un compte → page créer un compte
	Login → page se connecter
	Rang→ Entity Rang CRUD → ROLE_EDITEUR→ [Cheese Master, Super Cheese…]
	Voir une fiche user → rang → ses annonces

Échange -> 	Page Bourse d’échange

	P1 → if loger « CTA créer une annonce » else « CTA se connecter »
	P2 → Trouver une annonce par fromage ou par nom
	P3 → Annonces

	Trouver un formage
	Trouver un utilisateur
	Créer une annonce → ROLE_USER
	Voir une annonce → Répondre à une annonce → ROLE_USER
			
Fromage -> 	Page des fromages

	CRUD → ROLE_FROMAGER
	Single → redirect sur Wikipédia	

Events -> Page Events

	CRUD → ROLE_USER, validé par ROLE_EDITEUR ?
	Filtrer par date
	
Home -> Page Home
	
	P1 → CTA Inscription
	P2 → Explication du site → Inscription → trouver et ou créer une annonce → échanger
	P3 → Dernier échanges x5 (User 1 à échanger fromage 1 contre fromage 2 avec User 2) 
		P3b → CTA voir les annonces
	P4 → Dernier articles x3
		P4b → CTA voir tous nos articles
	P5 → Dernier events x3
		P5b → CTA voir tous nos événements

 
