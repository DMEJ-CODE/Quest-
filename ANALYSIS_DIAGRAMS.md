# 📊 Analyse Complète du Système - Diagrammes et Documentation

## 🎯 Vue d'ensemble du Projet

**Nom:** Voting System Q&A (Système de Vote Questions/Réponses)  
**Type:** Application Web MVC (PHP Vanilla)  
**Architecture:** MVC avec Pattern Repository  
**Database:** MySQL/PDO  
**Framework:** Custom Framework sans dépendances externes

---

## 📐 1. DIAGRAMME DE CAS D'UTILISATION (Use Case Diagram)

### Acteurs du Système:

1. **👤 Anonymous User (Utilisateur Anonyme)**
   - Non authentifié
   - Accès en lecture seule
   - Consulter questions, réponses, tags, leaderboard

2. **👤 Registered User (Utilisateur Enregistré)**
   - Authentifié avec session
   - Accès complet en lecture/écriture
   - Gestion de profil, contributions personnelles

3. **👨‍💼 Admin (Administrateur)**
   - Rôle = 'admin'
   - Tous les droits des utilisateurs enregistrés
   - Modération complète du contenu
   - Gestion des utilisateurs et tags
   - Accès aux analytiques

### Cas d'Utilisation Principaux:

#### 🔐 Authentification
- **Login/Register**: Création de compte
- **Logout**: Déconnexion
- **Forgot Password**: Récupération de mot de passe
- **Two-Factor Auth**: Authentification double

#### ❓ Gestion des Questions
- **View Questions**: Consulter feed de questions
- **Create Question**: Poser une nouvelle question
- **Edit Question**: Modifier sa question (owner only)
- **Delete Question**: Supprimer sa question (owner only)
- **Search Questions**: Rechercher par titre/description
- **Filter by Tags**: Filtrer par catégories

#### 💬 Gestion des Réponses
- **View Answers**: Voir les réponses à une question
- **Create Answer**: Répondre à une question
- **Edit Answer**: Modifier sa réponse (owner only)
- **Delete Answer**: Supprimer sa réponse (owner only)
- **Accept Answer**: Marquer une réponse comme correcte

#### 👍 Système de Votes
- **Upvote**: Voter positif (+1)
- **Downvote**: Voter négatif (-1)
- **Sync Vote Count**: Synchroniser les compteurs

#### 💭 Gestion des Commentaires
- **Create Comment**: Commenter une Q/R
- **Delete Comment**: Supprimer son commentaire (own/admin)
- **View Comments**: Voir les commentaires

#### 🏷️ Gestion des Tags
- **Browse Tags**: Explorer tous les tags
- **Follow Tag**: Suivre un tag
- **Unfollow Tag**: Ne plus suivre
- **Create Tag**: Créer un tag (lors question creation)
- **Delete Tag**: Supprimer un tag (admin only)

#### 👤 Gestion du Profil
- **View Profile**: Consulter profil utilisateur
- **Edit Profile**: Modifier son profil
- **View My Activity**: Historique d'activités
- **My Answers**: Toutes mes réponses
- **My Questions**: Toutes mes questions

#### 📊 Tableau de Bord
- **View Dashboard**: Statistiques personnelles
- **View Statistics**: Graphiques et tendances
- **View Activity Log**: Logs d'activité
- **Analytics**: Données analytiques (admin)

#### 🏆 Autres
- **View Leaderboard**: Classement utilisateurs
- **Manage Settings**: Paramètres généraux/langue
- **Change Password**: Modifier mot de passe
- **View Reports**: Signalements (admin)

---

## 🏗️ 2. DIAGRAMME DE CLASSE (Class Diagram)

### 📊 MODELS (Entités de Données)

#### **User**
```
Propriétés:
- id, username, email, password, name
- bio, avatar, role (user/admin), status
- created_at, updated_at

Méthodes:
+ find(id): User
+ all(): User[]
+ create(data): User
+ update(id, data): bool
+ delete(id): bool
+ getQuestions(userId): Question[]
+ getReputation(userId): int
+ getAnswers(userId): Answer[]
+ count(): int

Relations:
- Crée 1..* Question
- Poste 1..* Answer
- Lance 1..* Vote
- Écrit 1..* Comment
- Suit 1..* Tag (via UserTagFollows)
```

#### **Question**
```
Propriétés:
- id, user_id, title, description
- status (open/closed/resolved)
- votes (score global), views (compteur)
- answers_count, created_at, updated_at

Méthodes:
+ find(id): Question
+ all(): Question[]
+ create(data): Question
+ update(id, data): bool
+ delete(id): bool
+ incrementViews(id): void
+ createWithTags(data, tags): int
+ getTags(id): Tag[]
+ count(): int

Relations:
- Créée par 1 User
- Possède 1..* Answer
- Reçoit 1..* Vote
- Possède 1..* Comment
- Taguée par *..*  Tag
- Possède 0..1 Answer acceptée
```

#### **Answer**
```
Propriétés:
- id, question_id, user_id
- explanation (contenu)
- votes (score), is_accepted (bool)
- created_at, updated_at

Méthodes:
+ find(id): Answer
+ all(): Answer[]
+ create(data): Answer
+ update(id, data): bool
+ delete(id): bool
+ acceptAnswer(id): bool
+ count(): int

Relations:
- Réponse à 1 Question
- Auteur 1 User
- Reçoit 1..* Vote
- Possède 1..* Comment
```

#### **Vote**
```
Propriétés:
- id, user_id, target_id
- target_type (question/answer)
- vote_type (1 upvote, -1 downvote)
- created_at

Méthodes:
+ find(id): Vote
+ create(data): Vote
+ update(id, data): bool
+ delete(id): bool
+ getScore(targetId, type): int
+ userVote(userId, targetId, type): Vote

Relations:
- Voté par 1 User
- Cible Question OU Answer
```

#### **Comment**
```
Propriétés:
- id, user_id, target_id
- target_type (question/answer)
- content (texte)
- created_at, updated_at

Méthodes:
+ find(id): Comment
+ create(data): Comment
+ delete(id): bool
+ getForTarget(targetId, type): Comment[]

Relations:
- Écrit par 1 User
- Sur Question OU Answer
```

#### **Tag**
```
Propriétés:
- id, name, description
- created_at

Méthodes:
+ find(id): Tag
+ all(): Tag[]
+ create(data): Tag
+ update(id, data): bool
+ delete(id): bool
+ allWithCount(): Tag[]
+ count(): int

Relations:
- Tague *..*  Question
- Suivi par 1..* User (via UserTagFollows)
```

#### **QuestionTag** (Relation Many-to-Many)
```
Propriétés:
- question_id (FK)
- tag_id (FK)
+ Clé primaire composée (question_id, tag_id)
```

#### **UserTagFollows** (Relation de Suivi)
```
Propriétés:
- id, user_id (FK), tag_id (FK)
- created_at

Relations:
- 1 User suit 1 Tag
- Unicité: (user_id, tag_id)
```

---

### 🎮 CONTROLLERS (Contrôleurs)

#### **BaseController** (Abstract/Parent)
```
Propriétés protégées:
- db: PDO
- view: string

Méthodes publiques:
+ verifyAuth(): void          // Vérifier authentication
+ view(template, data): string   // Charger vue
+ renderPage(title, body, subtitle): string
+ setFlash(key, message): void  // Message flash
+ getFlash(key): string  
+ redirect(url): void
```

#### **AuthController** (extends BaseController)
```
Méthodes:
+ loginForm(): void
+ login(): void
+ registerForm(): void
+ register(): void
+ logout(): void
+ forgotForm(): void
+ forgot(): void

Gère: Authentification, Sessions, Mots de passe
```

#### **HomeController** (extends BaseController)
```
Méthodes:
+ index(): void

Affiche: Landing page avec stats
```

#### **QuestionController** (extends BaseController)
```
Méthodes:
+ index(): void              // Affiche feed
+ create(): void             // Formulaire nouveau
+ store(): void              // Sauvegarder
+ show(id): void             // Détail question
+ edit(id): void             // Formulaire édition
+ update(id): void           // Sauvegarder modification
+ destroy(id): void          // Supprimer
+ search(): void             // Recherche globale
+ loadMore(): void           // Infinite scroll AJAX
+ trending(): void           // Questions tendance
+ byTag(tagName): void       // Filtrer par tag

Utilise: Question, Tag
```

#### **AnswerController** (extends BaseController)
```
Méthodes:
+ store(): void              // Créer réponse
+ edit(id): void
+ update(id): void
+ destroy(id): void
+ accept(id): void           // Marquer comme acceptée

Utilise: Answer, Question, Vote, Comment
```

#### **VoteController** (extends BaseController)
```
Méthodes:
+ cast(): void               // Voter (AJAX)
- syncVoteCount(id, type): int
- verifyAuthApi(): void

Utilise: Vote, Question, Answer
Gère: Synchronisation des scores
```

#### **CommentController** (extends BaseController)
```
Méthodes:
+ store(): void              // Créer commentaire
+ destroy(id): void          // Supprimer

Utilise: Comment, Question, Answer
```

#### **ProfileController** (extends BaseController)
```
Méthodes:
+ show(id): void             // Afficher profil
+ update(id): void           // Modifier profil

Utilise: User, Question, Answer
```

#### **DashboardController** (extends BaseController)
```
Méthodes:
+ index(): void              // Dashboard principal
+ questions(): void          // Gestion questions
+ answers(): void            // Gestion réponses
+ members(): void            // Gestion utilisateurs (admin)
+ voting(): void             // Historique votes
+ tags(): void               // Gestion tags
+ generic(module, sub): void // Route générique
+ notifications(): void
+ settings(mode): void       // Paramètres système
+ profile(): void            // Profil utilisateur
+ analytics(): void          // Analytiques (admin)

Gère: Dashboard, Admin panels, Settings
Utilise: Tous les models
```

#### **TagsController** (extends BaseController)
```
Méthodes:
+ destroy(id): void          // Supprimer tag (admin)
+ follow(tagId): void        // Suivre tag (AJAX)
+ unfollow(tagId): void      // Ne plus suivre (AJAX)

Utilise: Tag, UserTagFollows
```

#### **UserController** (extends BaseController)
```
Méthodes:
+ destroy(id): void          // Supprimer utilisateur (admin)

Utilise: User
```

---

## 🔄 3. FLUX DE DONNÉES ET RELATIONS

### Flux Principal de Question/Réponse:

```
1. User accède /questions (QuestionController@index)
   ↓
2. Affiche liste Question avec User.name agrégés
   ↓
3. User clique question
   ↓
4. QuestionController@show charge:
   - Question détails
   - Answer[] avec User agrégés
   - Comment[] pour question et chaque answer
   - Tag[] liés
   ↓
5. User crée Answer (AnswerController@store)
   - Crée Answer
   - Incrémente Question.answers_count
   - Ajoute votes=0
   ↓
6. Utilisateurs votent (VoteController@cast)
   - INSERT/UPDATE Vote
   - Sync Vote.votes dans Question/Answer
   ↓
7. Owner mark Answer acceptée (AnswerController@accept)
   - UPDATE Answer.is_accepted = 1
```

### Relation Tag au Questions:

```
User crée Question avec tags
    ↓
INSERT Question
    ↓
POUR CHAQUE tag:
  - Chercher/créer Tag
  - INSERT question_tag (question_id, tag_id)
    ↓
Question.getTags() retourne Tag[] liés
    ↓
Filter par tag: Question.byTag()
  - JOIN question_tag, tags
  - WHERE tags.name = ?
```

### Suivi de Tags:

```
User clique "Follow" sur un Tag
    ↓
TagsController@follow (AJAX)
    ↓
INSERT user_tag_follows (user_id, tag_id)
  + UNIQUE (user_id, tag_id)
    ↓
Dashboard/tags/followed
  - SELECT tags FROM user_tag_follows
  - WHERE user_id = ?
    ↓
Update button état (Follow ↔ Following)
```

---

## 🗃️ 4. SCHÉMA DE BASE DE DONNÉES

### Tables Principales:

```sql
-- Users
users (
  id INT PK AUTO_INCREMENT,
  username VARCHAR(255) UNIQUE,
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  name VARCHAR(255),
  bio TEXT,
  avatar VARCHAR(255),
  role ENUM('user','admin'),
  status VARCHAR(50),
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  public_profile BOOLEAN DEFAULT 1
)

-- Questions
questions (
  id INT PK AUTO_INCREMENT,
  user_id INT FK → users.id,
  title VARCHAR(500),
  description TEXT,
  status ENUM('open','closed','resolved'),
  votes INT DEFAULT 0,
  views INT DEFAULT 0,
  answers_count INT DEFAULT 0,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
)

-- Answers
answers (
  id INT PK AUTO_INCREMENT,
  question_id INT FK → questions.id,
  user_id INT FK → users.id,
  explanation TEXT,
  votes INT DEFAULT 0,
  is_accepted BOOLEAN DEFAULT 0,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
)

-- Votes
votes (
  id INT PK AUTO_INCREMENT,
  user_id INT FK → users.id,
  target_id INT,
  target_type ENUM('question','answer'),
  vote_type INT (1 ou -1),
  created_at TIMESTAMP,
  UNIQUE (user_id, target_id, target_type)
)

-- Comments
comments (
  id INT PK AUTO_INCREMENT,
  user_id INT FK → users.id,
  target_id INT,
  target_type ENUM('question','answer'),
  content TEXT,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
)

-- Tags
tags (
  id INT PK AUTO_INCREMENT,
  name VARCHAR(100) UNIQUE,
  description TEXT,
  created_at TIMESTAMP
)

-- Many-to-Many: Questions ↔ Tags
question_tag (
  question_id INT FK → questions.id,
  tag_id INT FK → tags.id,
  PRIMARY KEY (question_id, tag_id)
)

-- User Follows Tags
user_tag_follows (
  id INT PK AUTO_INCREMENT,
  user_id INT FK → users.id,
  tag_id INT FK → tags.id,
  created_at TIMESTAMP,
  UNIQUE (user_id, tag_id)
)

-- Autres tables:
- login_history
- 2fa_devices
- user_settings
- etc...
```

---

## 🎯 5. SCÉNARIOS DE CAS D'USAGE

### Scénario 1: Créer une Question
```
1. User clique "Ask Question"
2. Affiche form: title, description, tags
3. User saisit données
4. Submit → POST /questions
5. QuestionController@store:
   - Valide données
   - INSERT questions
   - Boucle sur tags[], crée si néces
   - INSERT question_tag
6. Redirect /questions/{id}
7. Affiche nouvelle question
```

### Scénario 2: Voter sur une Réponse
```
1. User clique upvote sur Answer
2. AJAX → POST /vote (JSON)
3. VoteController@cast:
   - Valide target_id, target_type, vote_type
   - Cherche vote existant
   - Si existe: DELETE (toggle)
   - Si n'existe pas: INSERT
   - syncVoteCount(answer_id, 'answer')
   - Retourne JSON nouvelles stats
4. Frontend update button visuel
5. Affiche nouveau score
```

### Scénario 3: Accepter une Réponse
```
1. Question owner clique "Accept" sur Answer
2. AnswerController@accept:
   - Verify owner
   - UPDATE answers SET is_accepted=1
   - Optionnel: addReputation()
3. Répos affichée en premier dans liste
4. Badge "Accepted Answer" apparaît
```

### Scénario 4: Filtrer Questions par Tag
```
1. User clique tag "PHP"
2. GET /questions/tagged/PHP
3. QuestionController@byTag:
   - Parse tag name
   - Query: JOIN question_tag qt ON...
   - WHERE tags.name = 'PHP'
   - Retourne questions avec ce tag
4. Affiche questions filtrées
5. Affiche breadcrumb: Questions > PHP
```

---

## 🔐 6. SÉCURITÉ ET VALIDATIONS

### Authentification:
- ✅ Session-based (`$_SESSION['user_id']`, `$_SESSION['user_role']`)
- ✅ verifyAuth() check dans chaque controller sensible
- ✅ Owner/Admin checks pour édition/suppression

### Protection CSRF:
- ⚠️ À implémenter: Token CSRF dans forms

### SQL Injection:
- ✅ Prepared Statements partout (PDO)

### Authorization:
- ✅ Owner can edit own Q/A  
- ✅ Admin can edit/delete all
- ✅ Vote: owner cannot vote own content (optionnel)

---

## 📋 7. ROUTES PRINCIPALES

```
PUBLIC:
GET  /                          → Home@index
GET  /questions                 → Question@index
GET  /questions/{id}            → Question@show
GET  /questions/tagged/{tag}    → Question@byTag
GET  /search?q=...              → Question@search

AUTH REQUIRED:
POST /questions/create          → Question@create
POST /questions                 → Question@store
POST /questions/{id}/update     → Question@update
POST /questions/{id}/delete     → Question@destroy
POST /answers                   → Answer@store
POST /vote                      → Vote@cast
GET  /profile/{id}              → Profile@show
POST /profile/update            → Profile@update
GET  /dashboard                 → Dashboard@index
POST /comments/store            → Comment@store

ADMIN:
POST /tags/{id}/follow          → Tags@follow
POST /tags/{id}/unfollow        → Tags@unfollow
POST /tags/{id}/delete          → Tags@destroy
GET  /dashboard/members         → Dashboard@members
GET  /dashboard/analytics       → Dashboard@analytics
```

---

## 🎓 RÉSUMÉ ARCHITECTURE

| Aspect | Détail |
|--------|--------|
| **Pattern** | MVC (Model-View-Controller) |
| **Framework** | Custom / Vanilla PHP |
| **Database** | MySQL + PDO |
| **Authentification** | Session-based |
| **Frontend** | PHP Templates (Blade-like) + Bootstrap 5 + JavaScript AJAX |
| **API** | RESTful avec JSON responses |
| **Validation** | Server-side (PDO prepared) |
| **Stateless** | Non (Session-based) |
| **Scalabilité** | Moyenne (custom framework) |

---

## 📌 POINTS CLÉS À RETENIR

1. **Modèle relationnel** bien structuré avec clés étrangères
2. **Controllers unifiés** pour logique métier
3. **Models statiques** pour requêtes communes
4. **AJAX partout** pour pas de reload
5. **Admin vs User** deux rôles principaux
6. **Tags système** central (questions, profils, leaderboard)
7. **Votes synchronisés** en temps réel
8. **Comments génériques** (question OU answer)
9. **User follows tags** → feed personnalisé

---

**Document généré**: 2026-03-29  
**Version**: 1.0  
**Statut**: Complet
