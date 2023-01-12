from tkinter import *
from PIL import ImageTk,Image
import pymysql
from tkinter import messagebox


# DB CONNECTION
con = pymysql.connect(host='localhost',port=3306,user='root',password='',database='python_test')
cur = con.cursor()

# Enter Table Names here
issueTable = "books_issued" 
bookTable = "books"

def delete():
    bid = bookInfo1.get()
    
    deleteSql = "delete from "+bookTable+" where bid = '"+bid+"'"
    deleteIssue = "delete from "+issueTable+" where bid = '"+bid+"'"
    try:
        cur.execute(deleteSql)
        con.commit()
        cur.execute(deleteIssue)
        con.commit()
        messagebox.showinfo('Success',"Book Record Deleted Successfully")
    except:
        messagebox.showinfo("Please check Book ID")
    
    bookInfo1.delete(0, END)
    root.destroy()

def deleteBook():
    global bookInfo1,Canvas1,con,cur,bookTable,root
    root = Tk()
    root.title("Library")
    root.minsize(width=400,height=400)
    root.geometry("600x500")
    
    Canvas1 = Canvas(root)
    Canvas1.config(bg="#446B79")
    Canvas1.pack(expand=True,fill=BOTH)

    headingFrame1 = Frame(root, bg="#42b883", bd=5)
    headingFrame1.place(relx=0.25, rely=0.1, relwidth=0.5, relheight=0.13)
        
    headingLabel = Label(headingFrame1, text="Delete Book", bg='black', fg='white', font=('Courier',15))
    headingLabel.place(relx=0,rely=0, relwidth=1, relheight=1)
    
    labelFrame = Frame(root,bg='black')
    labelFrame.place(relx=0.1,rely=0.3,relwidth=0.8,relheight=0.5) 

    # Book Id

    label1 = Label(labelFrame, text="Book Id: ", bg="black", fg="white", font=("Courier-Bold",12))
    label1.place(relx=0.05,rely=0.3, relheight=0.1)

    bookInfo1 = Entry(labelFrame)
    bookInfo1.place(relx=0.3,rely=0.3, relwidth=0.62, relheight=0.1)

    #Submit Button
    SubmitBtn = Button(root,text="SUBMIT",bg='#d1ccc0', fg='black',command=delete)
    SubmitBtn.place(relx=0.28,rely=0.9, relwidth=0.18,relheight=0.08)
    
    quitBtn = Button(root,text="Quit",bg='#f7f1e3', fg='black', command=root.destroy)
    quitBtn.place(relx=0.53,rely=0.9, relwidth=0.18,relheight=0.08)
    
    root.mainloop()
