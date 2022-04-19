/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.Clutchers.entities;

/**
 *
 * @author sinda
 */
public class Reclamation {
    private int id;
    private String sujet;
    private String content;
    private String nom;
    private String email;
    private boolean statut;

    
    public Reclamation(int id, String sujet, String content, String nom, String email, boolean statut) {
        this.id = id;
        this.sujet = sujet;
        this.content = content;
        this.nom = nom;
        this.email = email;
        this.statut = statut;
       
    }
    
    public Reclamation(){}

    public Reclamation(String sujet, String content, String nom, String email) {
        this.sujet = sujet;
        this.content = content;
        this.nom = nom;
        this.email = email;
    }
    

    public Reclamation(String sujet, String content, String nom, String email, boolean statut) {
        this.sujet = sujet;
        this.content = content;
        this.nom = nom;
        this.email = email;
        this.statut = statut;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getSujet() {
        return sujet;
    }

    public void setSujet(String sujet) {
        this.sujet = sujet;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public boolean getStatut() {
        return statut;
    }

    public void setStatut(boolean statut) {
        this.statut = statut;
    }

    @Override
    public String toString() {
        return "Reclamation{" + "id=" + id + ", sujet=" + sujet + ", content=" + content + ", nom=" + nom + ", email=" + email + ", statut=" + statut + '}';
    }
    
    
    
    
    
    
    
    
    
}
