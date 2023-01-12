from tkinter import *
from PIL import ImageTk,Image
import pymysql
from tkinter import messagebox



def View():
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

    headingLabel1 = Label(headingFrame1, text="View Books", bg="black", fg="white", font=("Arial",15))
    headingLabel1.place(relx=0, rely=0, relwidth=1, relheight=1)


    labelFrame = Frame(root,bg='black')
    labelFrame.place(relx=0.1,rely=0.4,relwidth=0.8,relheight=0.4)

    Label(labelFrame, text="%-10s%-40s%-30s%-20s"%('BID','Title','Author','Status'),bg='black',fg='white').place(relx=0.07,rely=0.1)
    Label(labelFrame, text="----------------------------------------------------------------------------",bg='black',fg='white').place(relx=0.05,rely=0.2)
    
    getBooks = "select * from "+bookTable

    
    try:
        cur.execute(getBooks)
        con.commit()
        books = cur.fetchall()
        y = 0.2
        for i in books:
            Label(labelFrame, text="%-10s%-30s%-30s%-20s"%(i[0],i[1],i[2],i[3]),bg='black',fg='white').place(relx=0.07,rely=y)
            y += 0.1
           
    except:
        messagebox.showinfo("Error","Failed to fetch files from database")


    quitBtn = Button(root,text="Quit",bg='#f7f1e3', fg='black', command=root.destroy)
    quitBtn.place(relx=0.4,rely=0.9, relwidth=0.18,relheight=0.08)

    root.mainloop()
