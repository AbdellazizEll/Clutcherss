/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.Clutchers.GUI;

import edu.Clutchers.entities.Categories;
import edu.Clutchers.entities.Produit;
import edu.Clutchers.entities.Reclamation;
import edu.Clutchers.services.CategoriesCrud;
import edu.Clutchers.services.ProduitCRUD;
import edu.Clutchers.services.ReclamationCRUD;
import java.io.IOException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;
import java.util.Optional;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.ComboBox;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.input.MouseEvent;
import javafx.stage.Modality;

/**
 * FXML Controller class
 *
 * @author sinda
 */
public class GestionProduitController implements Initializable {

    @FXML
    private TableColumn<Produit, Integer> tcIdprod;
    @FXML
    private TableColumn<Produit, String> tcNomprod;
    @FXML
    private TableColumn<Produit, String> tcImageprod;
    @FXML
    private TableColumn<Produit, Double> tcPrixprod;
    @FXML
    private TableColumn<Produit, String> tcDescprod;
    @FXML
    private TableColumn<Produit, Integer> tcQteprod;
        @FXML
    private TableColumn<?, ?> tcCatidprod;
    @FXML
    private TextField tfIdp;
    @FXML
    private TextField tfNomp;
    @FXML
    private TextField tfImagep;
    @FXML
    private TextField tfPrixp;
    @FXML
    private TextField tfDescp;
    @FXML
    private TextField tfQtep;
      @FXML
    private TextField tfCatidprod;
    @FXML
    private Button btnInsertprod;
    @FXML
    private Button btnUpdateprod;
    @FXML
    private Button btnDelteprod;
    @FXML
    private TableView<Categories> tvCat;
    @FXML
    private TableColumn<Categories, Integer> tcIdCat;
    @FXML
    private TableColumn<Categories, String> tcNomCat;
    @FXML
    private TextField tfIdcat;
    @FXML
    private TextField tfNomcat;
    @FXML
    private Button btnInsertcat;
    @FXML
    private Button btnUpdateCat;
    @FXML
    private Button btnDeletecat;
    @FXML
    private TableView<Reclamation> tableview;
    @FXML
    private TableColumn<Reclamation, String> tcSujet;
    @FXML
    private TableColumn<Reclamation, String> tcContent;
    @FXML
    private TableColumn<Reclamation, String> tcNom;
    @FXML
    private TableColumn<Reclamation, String> tcEmail;
    @FXML
    private TableColumn<Reclamation, String> tcStatus;
    @FXML
    private TextField tfSujet;
    @FXML
    private TextArea tfContent;
    @FXML
    private TextField tfNom;
    @FXML
    private TextField tfEmail;
    @FXML
    private TextField tfStatut;
    @FXML
    private Button btnDeleterec;
    @FXML
    private Button btnUpdaterec;
    @FXML
    private TableView<Produit> tvProduit;
    @FXML
    private Button btnRetour;
    @FXML
    private ComboBox<String> CBCat;

  List<String> combox=new ArrayList<>();
    public void combox_I(){
        CategoriesCrud iss=new CategoriesCrud();
        combox =iss.combox_cat();
       
    }

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
       combox_I();
       CBCat.setItems(FXCollections.observableArrayList(combox));
      
        
        //affichage categories
        CategoriesCrud cc = new CategoriesCrud ();
        List categories = cc.afficherCategories();
        ObservableList list = FXCollections.observableArrayList(categories);
        tvCat.setItems(list);
        tcIdCat.setCellValueFactory(new PropertyValueFactory<>("id"));
        tcNomCat.setCellValueFactory(new PropertyValueFactory<>("nom_c"));
      
        //affichage reclamation
        ReclamationCRUD rc = new ReclamationCRUD();
        List reclamations = rc.afficherRec();
        ObservableList list2 = FXCollections.observableArrayList(reclamations);
        tableview.setItems(list2);
        tcSujet.setCellValueFactory(new PropertyValueFactory<>("sujet"));
        tcContent.setCellValueFactory(new PropertyValueFactory<>("content"));
        tcNom.setCellValueFactory(new PropertyValueFactory<>("nom"));
        tcEmail.setCellValueFactory(new PropertyValueFactory<>("email"));
        tcStatus.setCellValueFactory(new PropertyValueFactory<>("statut"));
        
        // affichage produit
        
        ProduitCRUD pc = new ProduitCRUD ();
        List produits = pc.afficherProd();
        ObservableList list3 = FXCollections.observableArrayList(produits);
        tvProduit.setItems(list3);
        tcIdprod.setCellValueFactory(new PropertyValueFactory<>("id"));
        tcNomprod.setCellValueFactory(new PropertyValueFactory<>("nom"));
        tcImageprod.setCellValueFactory(new PropertyValueFactory<>("image"));
        tcPrixprod.setCellValueFactory(new PropertyValueFactory<>("prix"));
        tcDescprod.setCellValueFactory(new PropertyValueFactory<>("description"));
        tcQteprod.setCellValueFactory(new PropertyValueFactory<>("qte"));
        //tcCatidprod.setCellFactory(new PropertyValueFactory<>("cat_id"));
        
        
        
        
        
        
    }    
    
    @FXML
    public void affInInputs(MouseEvent event){
       Categories av=tvCat.getSelectionModel().getSelectedItem();
      
       tfNomcat.setText(av.getNom_c());
      int n=av.getId();
       String m=Integer.toString(n);
       tfIdcat.setText(m);
      
    }

    @FXML
    private void ajouterProd(ActionEvent event) {
     if (tfPrixp.getText().isEmpty()) {
            tfPrixp.requestFocus();
            //Animations.shake(txtNom);
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            return;
        }
     if (tfNomp.getText().isEmpty()) {
            tfNomp.requestFocus();
            //Animations.shake(txtNom);
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            return;
        }
     if (tfImagep.getText().isEmpty()) {
            tfImagep.requestFocus();
            //Animations.shake(txtNom);
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            return;
        }
     if (tfDescp.getText().isEmpty()) {
            tfDescp.requestFocus();
            //Animations.shake(txtNom);
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            return;
        }
     if (tfQtep.getText().isEmpty()) {
            tfQtep.requestFocus();
            //Animations.shake(txtNom);
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            return;
        }
        
        
        Produit p = new Produit(Double.parseDouble(tfPrixp.getText()),tfNomp.getText(),tfImagep.getText(),tfDescp.getText(),Integer.parseInt(tfQtep.getText()),7);
        ProduitCRUD pc = new ProduitCRUD ();
        System.out.println(" essai 1");
        
        pc.ajouterProd(p);
        
        System.out.println(" essai 2");
        List produits = pc.afficherProd();
        ObservableList list = FXCollections.observableArrayList(produits);
        tvProduit.setItems(list);
        Alert a = new Alert(Alert.AlertType.CONFIRMATION," Produit ajouté ",ButtonType.OK);
        a.show();
         init();
    }

    @FXML
    private void modifierProd(ActionEvent event) {
         if (tfPrixp.getText().isEmpty()) {
            tfPrixp.requestFocus();
            //Animations.shake(txtNom);
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            return;
        }
     if (tfNomp.getText().isEmpty()) {
            tfNomp.requestFocus();
            //Animations.shake(txtNom);
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            return;
        }
     if (tfImagep.getText().isEmpty()) {
            tfImagep.requestFocus();
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            //Animations.shake(txtNom);
            return;
        }
     if (tfDescp.getText().isEmpty()) {
            tfDescp.requestFocus();
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            //Animations.shake(txtNom);
            return;
        }
     if (tfQtep.getText().isEmpty()) {
            tfQtep.requestFocus();
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            //Animations.shake(txtNom);
            return;
        }
        
       Produit av=tvProduit.getSelectionModel().getSelectedItem();
       Produit c = new Produit();
       c.setId(av.getId());
       c.setNom(tfNomp.getText());
       c.setImage(tfImagep.getText());
      
       String m=tfPrixp.getText();
       Double str1 = Double.valueOf(m); 

       c.setPrix(str1);
       c.setDescription(tfDescp.getText());
       
        String q=tfQtep.getText();
       int str2 = Integer.parseInt(q); 
       
       c.setQte(str2);
      
       
       //c.setNom_c(m);
       ProduitCRUD as=new ProduitCRUD();
        Alert alert = new Alert(AlertType.CONFIRMATION, "Voulez vous modifier le produit  " + c.getNom()+ " ?", ButtonType.YES, ButtonType.NO, ButtonType.CANCEL);
       alert.showAndWait();
       if (alert.getResult() == ButtonType.YES) {
       as.modifierProd(c);
       
        List produits = as.afficherProd();
       ObservableList list = FXCollections.observableArrayList(produits);
       tvProduit.setItems(list);
       init();
       }
       
    
       
        
    }

    @FXML
    private void SupprimerProd(ActionEvent event) {
        Produit p = tvProduit.getSelectionModel().getSelectedItem();
       ProduitCRUD pc = new ProduitCRUD();
        
       Alert alert = new Alert(AlertType.CONFIRMATION, "Voulez vous supprimer le produit  " + p.getNom() + " ?", ButtonType.YES, ButtonType.NO, ButtonType.CANCEL);
       alert.showAndWait();
       if (alert.getResult() == ButtonType.YES) {
            pc.supprimerProd(p.getId());
            List produits = pc.afficherProd();
            ObservableList list = FXCollections.observableArrayList(produits);
            tvProduit.setItems(list);
         
                 
            Alert a = new Alert(Alert.AlertType.CONFIRMATION," LE Produit "+ p.getNom()+ " a été supprimé\"",ButtonType.OK);
            a.show();
      
            tvProduit.refresh();
            }
       
    }


    @FXML
    private void ajouterCat(ActionEvent event) {
         if (tfNomcat.getText().isEmpty()) {
            tfNomcat.requestFocus();
            //Animations.shake(txtNom);
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            return;
        }
   
        
         Categories c = new Categories(tfNomcat.getText());
        CategoriesCrud cc = new CategoriesCrud ();
        cc.ajouterCategories(c);
      List categories = cc.afficherCategories();
       ObservableList list = FXCollections.observableArrayList(categories);
       tvCat.setItems(list);
        tvCat.refresh();
        Alert a = new Alert(Alert.AlertType.CONFIRMATION," categoeie ajoutée ",ButtonType.OK);
        tvCat.refresh();
        a.show();
         init();
       
    }

    @FXML
    private void modifierCat(ActionEvent event) {
    
        if (tfNomcat.getText().isEmpty()) {
            tfNomcat.requestFocus();
            //Animations.shake(txtNom);
            Alert missingFields = new Alert(Alert.AlertType.INFORMATION);
                missingFields.setHeaderText(null);
                missingFields.setContentText("veuillez remplir tout les champs");
                missingFields.initModality(Modality.APPLICATION_MODAL);
                missingFields.showAndWait();
            return;
        }
       Categories av=tvCat.getSelectionModel().getSelectedItem();
       int n=av.getId();
       String m=tfNomcat.getText();
     
       Categories c = new Categories();
       c.setId(n);
       c.setNom_c(m);
       CategoriesCrud as=new CategoriesCrud();
        Alert alert = new Alert(AlertType.CONFIRMATION, "Voulez vous modifier la categorie  " + c.getNom_c()+ " ?", ButtonType.YES, ButtonType.NO, ButtonType.CANCEL);
       alert.showAndWait();
       if (alert.getResult() == ButtonType.YES) {
       as.modifier(c);
       
         List categories = as.afficherCategories();
       ObservableList list = FXCollections.observableArrayList(categories);
       tvCat.setItems(list);
       init();}
    }

    @FXML
    private void supprimerCat(ActionEvent event) {
       Categories c = tvCat.getSelectionModel().getSelectedItem();
       CategoriesCrud cc = new CategoriesCrud();
        Alert alert = new Alert(AlertType.CONFIRMATION, "Voulez vous supprimer la categorie  " + c.getNom_c()+ " ?", ButtonType.YES, ButtonType.NO, ButtonType.CANCEL);
       alert.showAndWait();
       if (alert.getResult() == ButtonType.YES) {
       cc.supprimer(c.getId());
        List categories = cc.afficherCategories();
       ObservableList list = FXCollections.observableArrayList(categories);
       tvCat.setItems(list);
       
       tvCat.refresh();}
    }

    @FXML
    private void supprimerReclamation(ActionEvent event) {
       Reclamation p = tableview.getSelectionModel().getSelectedItem();
       ReclamationCRUD pc = new ReclamationCRUD();
        Alert alert = new Alert(AlertType.CONFIRMATION, "Voulez vous supprimer la reclamation  " + p.getNom()+ " ?", ButtonType.YES, ButtonType.NO, ButtonType.CANCEL);
       alert.showAndWait();
       if (alert.getResult() == ButtonType.YES) {
       pc.supprimer(p.getId());
        List reclamations = pc.afficherRec();
       ObservableList list = FXCollections.observableArrayList(reclamations );
        tableview.setItems(list);
       
       tableview.refresh();}

    }

    private void init()
    {
      
       tfIdcat.setText("");
      tfSujet.setText("");
      tfContent.setText("");
       tfNom.setText("");
       tfEmail.setText("");
      tfStatut.setText("");
       tfNomcat.setText("");
     
       tfIdcat.setText("");
        tfIdp.setText("");
       tfNomp.setText("");
       tfImagep.setText("");
       tfPrixp.setText("");
       tfDescp.setText("");
       tfQtep.setText("");
       tfIdcat.setText("");
    
    }
    
    
    
    @FXML
    private void modifierReclamation(ActionEvent event) {
        
        
       Reclamation av=tableview.getSelectionModel().getSelectedItem();
       int n=av.getId();
       Boolean m=av.getStatut();
     
       Reclamation   c= new Reclamation();
       c.setId(n);
       c.setStatut(m);
       ReclamationCRUD as=new  ReclamationCRUD();
       c.setStatut(true);
       as.modifier(c);
        List reclamations = as.afficherRec();
        ObservableList list = FXCollections.observableArrayList(reclamations );
        tableview.setItems(list);
       
       tableview.refresh();
       
       init();
        
    }

    @FXML
    private void Retour(ActionEvent event) throws IOException {
         FXMLLoader loader = new FXMLLoader(getClass().getResource("FirstPage.fxml"));
         Parent root = loader.load();
         FirstPageController ap = loader.getController();
         btnRetour.getScene().setRoot(root);
    }

    private void afficher(ActionEvent event) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    @FXML
    private void affInInputsRec(MouseEvent event) {
         Reclamation av= tableview.getSelectionModel().getSelectedItem();
         
         
       int n=av.getId();
       String m=Integer.toString(n);
       tfIdcat.setText(m);
      tfSujet.setText(av.getSujet());
      tfContent.setText(av.getContent());
       tfNom.setText(av.getNom());
       tfEmail.setText(av.getEmail());
      Boolean s=av.getStatut();
      String ss=Boolean.toString(s);
      tfStatut.setText(ss);
       
      
    }

    @FXML
    private void affInInputsProd(MouseEvent event) {
        Produit pp = tvProduit.getSelectionModel().getSelectedItem();
         int n=pp.getId();
       String m=Integer.toString(n);
       tfIdp.setText(m);
       tfNomp.setText(pp.getNom());
       tfImagep.setText(pp.getImage());
       Double p=pp.getPrix();
       String r=Double.toString(p);
       tfPrixp.setText(r);
       tfDescp.setText(pp.getDescription());
       int q=pp.getQte();
       String qt=Integer.toString(q);
       tfQtep.setText(qt);
        int i=pp.getCat_id();
       String id=Integer.toString(i);
       tfIdcat.setText(id);
        
    }
    
}
