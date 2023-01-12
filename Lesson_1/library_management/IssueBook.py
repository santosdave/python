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
    
#List To store all Book IDs
allBid = [] 

def issue():
    global issueBtn,labelFrame,label1,label2,bookInfo1,bookInfo2,quitBtn,root,Canvas1,status
    bid = bookInfo1.get()
    issueto = bookInfo2.get()

    issueBtn.destroy()
    labelFrame.destroy()
    label1.destroy()
    label2.destroy()
    bookInfo1.destroy()
    bookInfo2.destroy()


    getBook = "select * from "+bookTable+" where bid = '"+bid+"'"

    try:
        cur.execute(getBook)
        con.commit()
        books = cur.fetchall()

        if len(books) >  0:
            checkAvail = "select status from "+bookTable+" where bid = '"+bid+"'"
            cur.execute(checkAvail)
            con.commit()
            for i in cur:
                check = i[0]
                if check == 'available':
                    issueSql = "insert into "+issueTable+" values ('"+bid+"','"+issueto+"')"
                    updateStatus = "update "+bookTable+" set status = 'issued' where bid = '"+bid+"'"
                    try:
                        cur.execute(issueSql)
                        con.commit()
                        cur.execute(updateStatus)
                        con.commit()
                        messagebox.showinfo('Success',"Book Issued Successfully")
                        root.destroy()
                    except:
                        messagebox.showinfo("Search Error","The value entered is wrong, Try again")
                elif check == "issued":
                        messagebox.showinfo("Success","This book is already issued")
                else:
                    messagebox.showinfo("Error","This book is not available")
        else:
             messagebox.showinfo("Error","No Book found with this id")
    except:
         messagebox.showinfo("Error","Failed to fetch files from database")

def issueBook():
    global issueBtn,labelFrame,label1,label2,bookInfo1,bookInfo2,quitBtn,root,Canvas1,status
    root = Tk()
    root.title("Library")
    root.minsize(width=400,height=400)
    root.geometry("600x500")
    
    Canvas1 = Canvas(root)

    Canvas1.config(bg="#446B79")
    Canvas1.pack(expand=True,fill=BOTH)

    headingFrame1 = Frame(root, bg="#42b883", bd=5)
    headingFrame1.place(relx=0.25, rely=0.1, relwidth=0.5, relheight=0.13)
        
    headingLabel = Label(headingFrame1, text="Issue Book", bg='black', fg='white', font=('Courier',15))
    headingLabel.place(relx=0,rely=0, relwidth=1, relheight=1)
    
    labelFrame = Frame(root,bg='black')
    labelFrame.place(relx=0.1,rely=0.3,relwidth=0.8,relheight=0.5) 


    # BOOK ID
    label1 = Label(labelFrame, text="Book ID: ", bg="black", fg="white", font=("Courier-Bold",  12))
    label1.place(relx=0.05,rely=0.3, relheight=0.1)

    bookInfo1 = Entry(labelFrame)
    bookInfo1.place(relx=0.3,rely=0.3, relwidth=0.62, relheight=0.1)

    # ISSUED TO
    label2 = Label(labelFrame, text="Issued To: ", bg="black", fg="white", font=("Courier-Bold",  12))
    label2.place(relx=0.05,rely=0.6, relheight=0.1)

    bookInfo2 = Entry(labelFrame)
    bookInfo2.place(relx=0.3,rely=0.6, relwidth=0.62, relheight=0.1)

    # ISSUED BUTTON
    issueBtn = Button(root,text="Issue",bg='#d1ccc0', fg='black',command=issue)
    issueBtn.place(relx=0.28,rely=0.9, relwidth=0.18,relheight=0.08)
    
    quitBtn = Button(root,text="Quit",bg='#aaa69d', fg='black', command=root.destroy)
    quitBtn.place(relx=0.53,rely=0.9, relwidth=0.18,relheight=0.08)
    
    root.mainloop()
