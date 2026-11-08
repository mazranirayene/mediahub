# API Publications — Documentation

API REST de gestion de publications (articles) avec authentification par token Sanctum.

## Sommaire

- [URL de base](#url-de-base)
- [Authentification](#authentification)
- [Format des réponses](#format-des-réponses)
- [Pagination](#pagination)
- [Codes HTTP utilisés](#codes-http-utilisés)
- [Tableau récapitulatif des points d'accès](#tableau-récapitulatif-des-points-daccès)
- [Détail des points d'accès](#détail-des-points-daccès)

---

## URL de base

| Environnement | URL |
| :--- | :--- |
| Développement | `http://127.0.0.1:8000/api` |
| Production | *(à renseigner)* |

Tous les endpoints sont préfixés par `/api`. Les requêtes doivent inclure les en-têtes :

```
Accept: application/json
Content-Type: application/json
```

---

## Authentification

L'API utilise **Laravel Sanctum** avec des tokens Bearer.

### Obtenir un token

Appelle `POST /connexion` avec ton email et mot de passe. La réponse contient un `token`.

### Utiliser un token

Ajoute l'en-tête suivant à chaque requête protégée :

```
Authorization: Bearer 1|abc123xyz...
```

⚠️ Le préfixe `Bearer ` (avec un espace) est **obligatoire**.

### Endpoints protégés vs publics

- 🟢 **Publics** : `GET /publications`, `GET /publications/{id}`, `POST /connexion`
- 🔒 **Protégés** : `POST /publications`, `PUT /publications/{id}`, `DELETE /publications/{id}`, `GET /user`

Les endpoints protégés renvoient `401 Unauthorized` sans token valide.

---

## Format des réponses

Toutes les réponses sont au format **JSON**.

### Succès (objet unique)

Les réponses pour une ressource unique sont **enveloppées** dans une clé `data` :

```json
{
    "data": {
        "id": 1,
        "titre": "Mon article"
    }
}
```

### Succès (liste paginée)

```json
{
    "data": [ /* ... */ ],
    "links": { "first": "...", "last": "...", "prev": null, "next": "..." },
    "meta": { "current_page": 1, "per_page": 10, "total": 25, "last_page": 3 }
}
```

### Erreur (validation)

```json
{
    "message": "The titre field is required. (and 1 more error)",
    "errors": {
        "titre": ["The titre field is required."],
        "contenu": ["The contenu field is required."]
    }
}
```

### Erreur (authentification)

```json
{ "message": "Unauthenticated." }
```

### Erreur (autorisation)

```json
{ "message": "This action is unauthorized." }
```

---

## Pagination

L'endpoint `GET /publications` est paginé à **10 éléments par page**.

| Paramètre | Type | Défaut | Description |
| :--- | :--- | :--- | :--- |
| `page` | integer | `1` | Numéro de page à récupérer |

Exemple : `GET /publications?page=2`

Les métadonnées de pagination sont renvoyées dans `links` et `meta`.

---

## Codes HTTP utilisés

| Code | Signification | Contexte |
| :--- | :--- | :--- |
| `200 OK` | Succès | Lecture, mise à jour, connexion |
| `201 Created` | Ressource créée | `POST /publications` |
| `204 No Content` | Succès sans corps | `DELETE /publications/{id}` |
| `401 Unauthorized` | Token absent ou invalide | Routes protégées |
| `403 Forbidden` | Token valide mais action interdite | Modification/suppression d'une publication d'autrui |
| `404 Not Found` | Ressource inexistante | `GET/PUT/DELETE /publications/{id}` avec ID inconnu |
| `422 Unprocessable Content` | Données invalides | Validation échouée |
| `429 Too Many Requests` | Limite de tentatives atteinte | `/connexion` (rate limit) |

---

## Tableau récapitulatif des points d'accès

| Méthode | URL | Authentification | Description | Succès |
| :--- | :--- | :--- | :--- | :--- |
| `POST` | `/connexion` | ❌ Publique | Obtenir un token | `200` |
| `GET` | `/publications` | ❌ Publique | Liste paginée des publications | `200` |
| `GET` | `/publications/{id}` | ❌ Publique | Détail d'une publication | `200` |
| `POST` | `/publications` | 🔒 Bearer | Créer une publication | `201` |
| `PUT` \| `PATCH` | `/publications/{id}` | 🔒 Bearer | Modifier une publication (propriétaire uniquement) | `200` |
| `DELETE` | `/publications/{id}` | 🔒 Bearer | Supprimer une publication (propriétaire uniquement) | `204` |
| `GET` | `/user` | 🔒 Bearer | Utilisateur du token courant | `200` |

---

## Détail des points d'accès

### 🟢 POST /connexion

Obtenir un token d'authentification.

**Authentification :** aucune

**Corps de la requête**

| Champ | Type | Obligatoire | Description |
| :--- | :--- | :--- | :--- |
| `email` | string (email) | ✅ | Email de l'utilisateur |
| `password` | string | ✅ | Mot de passe en clair |

**Exemple de requête**

```http
POST /api/connexion HTTP/1.1
Host: 127.0.0.1:8000
Accept: application/json
Content-Type: application/json

{
    "email": "alice@example.com",
    "password": "password123"
}
```

**Exemple de réponse — `200 OK`**

```json
{
    "token": "1|Xy7fLmN2pQrStUvWxYzAbCdEfGhIjKlMnOpQrStU"
}
```

**Erreurs**

| Code | Cas |
| :--- | :--- |
| `401` | Identifiants incorrects → `{ "message": "Identifiants incorrects." }` |
| `422` | Champs manquants ou email invalide |
| `429` | Trop de tentatives (rate limit) |

---

### 🟢 GET /publications

Liste paginée des publications, triées par date de création décroissante.

**Authentification :** aucune

**Paramètres de requête**

| Paramètre | Type | Défaut | Description |
| :--- | :--- | :--- | :--- |
| `page` | integer | `1` | Numéro de page |

**Exemple de requête**

```http
GET /api/publications?page=1 HTTP/1.1
Host: 127.0.0.1:8000
Accept: application/json
```

**Exemple de réponse — `200 OK`**

```json
{
    "data": [
        {
            "id": 12,
            "titre": "Introduction à Laravel",
            "contenu": "Laravel est un framework...",
            "categorie": "Tech",
            "auteur": "Alice",
            "image": "http://127.0.0.1:8000/storage/publications/abc.jpg",
            "publie_le": "2026-11-08"
        },
        {
            "id": 11,
            "titre": "Guide des API REST",
            "contenu": "Une API REST est...",
            "categorie": "Tech",
            "auteur": "Bob",
            "image": null,
            "publie_le": "2026-11-07"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/publications?page=1",
        "last": "http://127.0.0.1:8000/api/publications?page=2",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/publications?page=2"
    },
    "meta": {
        "current_page": 1,
        "per_page": 10,
        "total": 12,
        "last_page": 2
    }
}
```

---

### 🟢 GET /publications/{id}

Détail d'une publication.

**Authentification :** aucune

**Paramètres de chemin**

| Paramètre | Type | Description |
| :--- | :--- | :--- |
| `id` | integer | Identifiant de la publication |

**Exemple de requête**

```http
GET /api/publications/12 HTTP/1.1
Host: 127.0.0.1:8000
Accept: application/json
```

**Exemple de réponse — `200 OK`**

```json
{
    "data": {
        "id": 12,
        "titre": "Introduction à Laravel",
        "contenu": "Laravel est un framework...",
        "categorie": "Tech",
        "auteur": "Alice",
        "image": "http://127.0.0.1:8000/storage/publications/abc.jpg",
        "publie_le": "2026-11-08"
    }
}
```

**Erreurs**

| Code | Cas |
| :--- | :--- |
| `404` | ID inexistant |

---

### 🔒 POST /publications

Créer une publication. L'auteur (`user_id`) est **automatiquement** défini à l'utilisateur du token — toute valeur envoyée dans le body est ignorée.

**Authentification :** Bearer token requis

**Corps de la requête**

| Champ | Type | Obligatoire | Description |
| :--- | :--- | :--- | :--- |
| `titre` | string (max 255) | ✅ | Titre de la publication |
| `contenu` | string | ✅ | Contenu de la publication |
| `categorie_id` | integer | ✅ | ID d'une catégorie existante |
| `image` | file (image, max 2 Mo) | ❌ | Image de couverture |

**Exemple de requête**

```http
POST /api/publications HTTP/1.1
Host: 127.0.0.1:8000
Accept: application/json
Content-Type: application/json
Authorization: Bearer 1|Xy7fLmN2pQrStUvWxYzAbCdEfGhIjKlMnOpQrStU

{
    "titre": "Mon nouvel article",
    "contenu": "Contenu de l'article...",
    "categorie_id": 1
}
```

**Exemple de réponse — `201 Created`**

```json
{
    "data": {
        "id": 13,
        "titre": "Mon nouvel article",
        "contenu": "Contenu de l'article...",
        "categorie": "Tech",
        "auteur": "Alice",
        "image": null,
        "publie_le": "2026-11-08"
    }
}
```

**Erreurs**

| Code | Cas |
| :--- | :--- |
| `401` | Token absent ou invalide |
| `422` | Validation échouée (titre/contenu manquants, catégorie inexistante, etc.) |

---

### 🔒 PUT/PATCH /publications/{id}

Modifier une publication. **Seul le propriétaire** (celui dont l'`id` correspond au `user_id` de la publication) peut effectuer cette action.

**Authentification :** Bearer token requis

**Paramètres de chemin**

| Paramètre | Type | Description |
| :--- | :--- | :--- |
| `id` | integer | Identifiant de la publication |

**Corps de la requête**

Tous les champs sont **optionnels** (mise à jour partielle supportée) :

| Champ | Type | Description |
| :--- | :--- | :--- |
| `titre` | string (max 255) | Nouveau titre |
| `contenu` | string | Nouveau contenu |
| `categorie_id` | integer | Nouvelle catégorie |
| `image` | file (image, max 2 Mo) | Nouvelle image |

**Exemple de requête**

```http
PUT /api/publications/13 HTTP/1.1
Host: 127.0.0.1:8000
Accept: application/json
Content-Type: application/json
Authorization: Bearer 1|Xy7fLmN2pQrStUvWxYzAbCdEfGhIjKlMnOpQrStU

{
    "titre": "Mon article modifié"
}
```

**Exemple de réponse — `200 OK`**

```json
{
    "data": {
        "id": 13,
        "titre": "Mon article modifié",
        "contenu": "Contenu de l'article...",
        "categorie": "Tech",
        "auteur": "Alice",
        "image": null,
        "publie_le": "2026-11-08"
    }
}
```

**Erreurs**

| Code | Cas |
| :--- | :--- |
| `401` | Token absent ou invalide |
| `403` | Publication appartenant à un autre utilisateur → `{ "message": "This action is unauthorized." }` |
| `404` | ID inexistant |
| `422` | Validation échouée |

---

### 🔒 DELETE /publications/{id}

Supprimer une publication. **Seul le propriétaire** peut effectuer cette action.

**Authentification :** Bearer token requis

**Paramètres de chemin**

| Paramètre | Type | Description |
| :--- | :--- | :--- |
| `id` | integer | Identifiant de la publication |

**Exemple de requête**

```http
DELETE /api/publications/13 HTTP/1.1
Host: 127.0.0.1:8000
Accept: application/json
Authorization: Bearer 1|Xy7fLmN2pQrStUvWxYzAbCdEfGhIjKlMnOpQrStU
```

**Exemple de réponse — `204 No Content`**

*Corps vide.*

**Erreurs**

| Code | Cas |
| :--- | :--- |
| `401` | Token absent ou invalide |
| `403` | Publication appartenant à un autre utilisateur |
| `404` | ID inexistant |

---

### 🔒 GET /user

Retourne les informations de l'utilisateur associé au token courant. Utile pour vérifier la validité d'un token.

**Authentification :** Bearer token requis

**Exemple de requête**

```http
GET /api/user HTTP/1.1
Host: 127.0.0.1:8000
Accept: application/json
Authorization: Bearer 1|Xy7fLmN2pQrStUvWxYzAbCdEfGhIjKlMnOpQrStU
```

**Exemple de réponse — `200 OK`**

```json
{
    "id": 1,
    "name": "Alice",
    "email": "alice@example.com",
    "email_verified_at": null,
    "created_at": "2026-11-01T10:00:00.000000Z",
    "updated_at": "2026-11-08T14:30:00.000000Z"
}
```

**Erreurs**

| Code | Cas |
| :--- | :--- |
| `401` | Token absent ou invalide |

---

## Modèle de données : Publication

| Champ | Type | Description |
| :--- | :--- | :--- |
| `id` | integer | Identifiant unique |
| `titre` | string | Titre de la publication |
| `contenu` | string | Contenu complet |
| `categorie` | string | **Nom** de la catégorie associée |
| `auteur` | string | **Nom** de l'utilisateur qui a créé la publication |
| `image` | string \| null | URL publique de l'image, `null` si absente |
| `publie_le` | string (date `YYYY-MM-DD`) | Date de création |

---

## Exemple d'intégration rapide

```bash
# 1. Obtenir un token
TOKEN=$(curl -s -X POST \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"email":"alice@example.com","password":"password123"}' \
  http://127.0.0.1:8000/api/connexion | jq -r '.token')

# 2. Lister les publications (public)
curl -H "Accept: application/json" \
  http://127.0.0.1:8000/api/publications

# 3. Créer une publication (protégé)
curl -X POST \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer $TOKEN" \
  -d '{"titre":"Nouvel article","contenu":"Contenu...","categorie_id":1}' \
  http://127.0.0.1:8000/api/publications
```