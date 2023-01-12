from tkinter import *
from PIL import ImageTk,Image
import pymysql
from tkinter import messagebox


def bookRegister():
        bid = bookInfo1.get()
        title = bookInfo2.get()
        author = bookInfo3.get()
        status = 'Available'
        status = status.lower()

        insertBooks = "insert into "+bookTable+" values('"+bid+"','"+title+"','"+author+"','"+status+"')"
        try:
            cur.execute(insertBooks)
            con.commit()
            messagebox.showinfo('Success',"Book added successfully")
        except:
            messagebox.showinfo("Error","Can't add data into Database")

        print(bid, title, author, status)
        root.destroy()
def addBook():
    global bookInfo1,bookInfo2,bookInfo3,Canvas1,con,cur,bookTable,root
    # DB CONNECTION
    con = pymysql.connect(host='localhost',port=3306,user='root',password='',database='python_test')
    cur = con.cursor()

    # SETTING UP GUI
    root = Tk()
    root.title('My Library')
    root.minsize(width=400,height=400)
    root.geometry("600x500")

    # TABLE NAMES

    bookTable = "books"

    Canvas1 = Canvas(root)
        
    Canvas1.config(bg="#446B79")
    Canvas1.pack(expand=True,fill=BOTH)


    headingFrame1 = Frame(root, bg="#42b883", bd=5)
    headingFrame1.place(relx=0.25, rely=0.1, relwidth=0.5, relheight=0.13)

    headingLabel1 = Label(headingFrame1, text="Add Books", bg="black", fg="white", font=("Arial",15))
    headingLabel1.place(relx=0, rely=0, relwidth=1, relheight=1)

    labelFrame = Frame(root,bg='black')
    labelFrame.place(relx=0.1,rely=0.4,relwidth=0.8,relheight=0.4)


    # BOOK ID

    label1 = Label(labelFrame, text="Book ID: ", bg="black", fg="white", font=("Courier-Bold",12))
    label1.place(relx=0.05, rely=0.2, relheight=0.1)

    bookInfo1 = Entry(labelFrame)
    bookInfo1.place(relx=0.3, rely=0.2, relwidth=0.62, relheight=0.1)

    # BOOK TITLE

    label2 = Label(labelFrame, text="Book Title: ", bg="black", fg="white", font=("Courier-Bold",12))
    label2.place(relx=0.05, rely=0.4, relheight=0.1)

    bookInfo2 = Entry(labelFrame)
    bookInfo2.place(relx=0.3, rely=0.4, relwidth=0.62, relheight=0.1)

    # BOOK AUTHOR

    label3 = Label(labelFrame, text="Book Author: ", bg="black", fg="white" , font=("Courier-Bold",12))
    label3.place(relx=0.05, rely=0.6, relheight=0.1)

    bookInfo3 = Entry(labelFrame)
    bookInfo3.place(relx=0.3, rely=0.6, relwidth=0.62, relheight=0.1)


        #Submit Button
    SubmitBtn = Button(root,text="SUBMIT",bg='#d1ccc0', fg='black',command=bookRegister)
    SubmitBtn.place(relx=0.28,rely=0.9, relwidth=0.18,relheight=0.08)
    
    quitBtn = Button(root,text="Quit",bg='#f7f1e3', fg='black', command=root.destroy)
    quitBtn.place(relx=0.53,rely=0.9, relwidth=0.18,relheight=0.08)
    


