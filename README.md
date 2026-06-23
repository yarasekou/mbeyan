# Mbeyan

**Application d'enregistrement, de géolocalisation et d'expertise de biens clients.**

---

## 📌 Description

Mbeyan est une plateforme web développée avec **Symfony** pour l'enregistrement, la géolocalisation et l'expertise de biens clients.  
Elle permet aux administrateurs, structures et clients particuliers de gérer des biens, des expertises, des documents et des géolocalisations.

---

## 🛠️ Stack technique

| Composant | Technologie |
|-----------|-------------|
| **Framework** | Symfony 6 |
| **Langage** | PHP 8+ |
| **ORM** | Doctrine |
| **Base de données** | MySQL |
| **Frontend** | Twig, Bootstrap, JavaScript |
| **Cartographie** | Google Maps API |
| **Emails** | SwiftMailer |
| **Sécurité** | Annotations `@Security`, rôles |

---

## 📦 Fonctionnalités

- ✅ Multi‑portails (Super‑Admin, Admin structure, Client particulier)
- ✅ Gestion des utilisateurs (rôles, activation, confirmation)
- ✅ Enregistrement des biens clients
- ✅ Géolocalisation complète (Région → Cercle → Commune → Quartier)
- ✅ Gestion des expertises
- ✅ Gestion des documents (images, PDF)
- ✅ Cartographie interactive (Google Maps)
- ✅ Génération de PDF (rapports d'expertise)
- ✅ Système de rôles et permissions (`ROLE_SUPER_ADMIN`, `ROLE_ADMIN`)

---

## 🚀 Installation et lancement

### Prérequis

- PHP 8.1+
- Composer
- MySQL
- Node.js (pour les assets)

### Cloner le projet

```bash
git clone https://github.com/yarasekou/mbeyan.git
cd mbeyan
