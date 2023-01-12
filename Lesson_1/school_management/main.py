import datetime

from tkinter import *
import tkinter.messagebox as mb
from tkinter import ttk
from tkcalendar import DateEntry
import sqlite3


# Database connection
connector = sqlite3.connect('SchoolManagement.db')
cursor = connector.cursor()
connector.execute(
"CREATE TABLE IF NOT EXISTS SCHOOL_MANAGEMENT (STUDENT_ID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, NAME TEXT, EMAIL TEXT, PHONE_NO TEXT, GENDER TEXT, DOB TEXT, STREAM TEXT)"
)


# Functions

def get_school_management():
    cursor.execute("SELECT * FROM SCHOOL_MANAGEMENT")
    results = cursor.fetchall()
    # return results
    print(results)

def reset_form_fields():
    global student_name, student_email, student_contact, student_stream, student_gender,student_dob

    for i in ['student_name', 'student_email', 'student_contact', 'student_stream', 'student_gender','student_dob']:
       exec(f"{i}.set('')")
    student_dob.set_date(datetime.datetime.now().date)

def display_students():
    table.delete(*table.get_children())

    curr = connector.execute('SELECT * FROM SCHOOL_MANAGEMENT')
    data = curr.fetchall()

    for row in data:
        table.insert('', END, values=row)

def add_student_record():
    global student_name, student_email, student_contact, student_stream, student_gender,student_dob

    name = student_name.get()
    email= student_email.get()
    contact= student_contact.get()
    stream= student_stream.get()
    gender= student_gender.get()
    dob= '02/12/2022'


    if not name or not email or not contact or not stream or not gender or not dob:
        mb.showerror(title="Error", message='Please fill all the required fields')
    else:
        try:
            connector.execute(
                'INSERT INTO SCHOOL_MANAGEMENT (NAME, EMAIL, PHONE_NO, GENDER, DOB, STREAM) VALUES(?,?,?,?,?,?)',
                (name, email, contact, gender, dob, stream)
            )
            connector.commit()
            mb.showinfo('Record Added', 'Student Record has been added successfully')
            display_students()
            reset_form_fields()
        except ValueError:
            mb.showerror(title="Wrong type", message='The type of values entered was not correct. Please note contact field requires only numbers')

def remove_students_record():
    if not table.selection():
        mb.showerror(title="Error", message='Please select a student record')
    else:
        try:
            current_record = table.focus()
            values = table.item(current_record)
            selection = values['values']
           
            connector.execute('DELETE FROM SCHOOL_MANAGEMENT WHERE STUDENT_ID=%d' % selection[0])
            connector.commit()
            table.delete(current_record)
            display_students()
            mb.showerror(title="Success", message="Student record was successfully removed")
            display_students()
        except Exception:
            mb.showerror(title="Error", message='Operation failed')
      


# Initializing UI window


root = Tk()
root.title('School Management System')
root.minsize(width=400,height=400)
root.geometry("1000x600")


# Color variable

sidebar = 'MediumSpringGreen'
content = 'PaleGreen'

# Form variables
student_name = StringVar()
student_email = StringVar()
student_contact = StringVar()
student_gender = StringVar()
student_stream = StringVar()

# Content

Label(root, text="My School Management Sytem Project", bg='SpringGreen', font='Calibri').pack(side=TOP, fill=X)
Label(root, text="By Santos Dave", bg='SpringGreen', font='Calibri').pack(side=BOTTOM, fill=X)

left_sidebar_div = Frame(root, bg=sidebar)
left_sidebar_div.place(x=0, y=30, relheight=1, relwidth=0.2)

content_div = Frame(root, bg=content)
content_div.place(relx=0.2, y=30, relheight=1, relwidth=0.2)

right_sidebar_div = Frame(root, bg="Gray35")
right_sidebar_div.place(relx=0.4, y=30, relheight=1, relwidth=0.6)

# Left sidebar components
Label(left_sidebar_div, text="Student Name", font="Helvetica", bg=sidebar).place(relx=0.175, rely=0.02)
Entry(left_sidebar_div, textvariable=student_name).place(relx=0.175, rely=0.07)

Label(left_sidebar_div, text="Student Contacts", font="Helvetica", bg=sidebar).place(relx=0.175, rely=0.12)
Entry(left_sidebar_div, textvariable=student_contact).place(relx=0.175, rely=0.17)

Label(left_sidebar_div, text="Student Email", font="Helvetica", bg=sidebar).place(relx=0.175, rely=0.22)
Entry(left_sidebar_div, textvariable=student_email).place(relx=0.175, rely=0.27)

Label(left_sidebar_div, text="Student Gender", font="Helvetica", bg=sidebar).place(relx=0.175, rely=0.32)
OptionMenu(left_sidebar_div,student_gender, 'Male','Female').place(relx=0.175, rely=0.37, relwidth=0.6)


Label(left_sidebar_div, text="Student D.O.B", font="Helvetica", bg=sidebar).place(relx=0.175, rely=0.44)
student_dob = DateEntry(left_sidebar_div, font='Helvetica', width=11).place(relx=0.175, rely=0.49)


Label(left_sidebar_div, text="Student Stream", font="Helvetica", bg=sidebar).place(relx=0.175, rely=0.54)
Entry(left_sidebar_div, textvariable=student_stream).place(relx=0.175, rely=0.59)


Button(left_sidebar_div, text="Save Record", bg='black',fg="white", font="Helvetica", width=12 , command=add_student_record).place(relx=0.175, rely=0.75)

# Center Div components

Button(content_div, text="Reset Fields", bg="black",fg="white", font="Helvetica", width=13 , command=reset_form_fields).place(relx=0.175, rely=0.55)
Button(content_div, text="View Record", bg="black",fg="white", font="Helvetica", width=13).place(relx=0.175, rely=0.15)
Button(content_div, text="Delete Record", bg="black",fg="white", font="Helvetica", width=13, command=remove_students_record).place(relx=0.175, rely=0.35)
Button(content_div, text="Delete Database", bg="black",fg="white", font="Helvetica", width=13, command=get_school_management).place(relx=0.175, rely=0.75)

# Right Div Components

Label(right_sidebar_div, text="Students Records", font='Helvetica', bg="DarkGreen", fg="LightCyan").pack(side=TOP, fill=X)

table= ttk.Treeview(right_sidebar_div,height=100, selectmode=BROWSE,columns=('Student ID', 'Name', 'Email Address', 'Contact Number', 'Gender', 'D.O.B', 'Stream'))

Overflow_X_Scroll = Scrollbar(table, orient=HORIZONTAL)
Overflow_Y_Scroll = Scrollbar(table, orient=VERTICAL)

Overflow_X_Scroll.pack(side=BOTTOM, fill=Y)
Overflow_Y_Scroll.pack(side=RIGHT, fill=Y)

table.config(yscrollcommand=Overflow_Y_Scroll.set, xscrollcommand=Overflow_X_Scroll.set)


table.heading('Student ID', text="ID", anchor=CENTER)
table.heading('Name', text="Name", anchor=CENTER)
table.heading('Email Address', text="Email", anchor=CENTER)
table.heading('Contact Number', text="Phone No", anchor=CENTER)
table.heading('Gender', text="Gender", anchor=CENTER)
table.heading('D.O.B', text="DOB", anchor=CENTER)
table.heading('Stream', text="Stream", anchor=CENTER)

table.column('#0', width=0, stretch=NO , anchor=CENTER)
table.column('#1', width=40, stretch=NO , anchor=CENTER)
table.column('#2', width=120, stretch=NO , anchor=CENTER)
table.column('#3', width=120, stretch=NO , anchor=CENTER)
table.column('#4', width=70, stretch=NO , anchor=CENTER)
table.column('#5', width=70, stretch=NO, anchor=CENTER)
table.column('#6', width=70, stretch=NO , anchor=CENTER)
table.column('#7', width=100, stretch=NO, anchor=CENTER)



table.place(y=30,relwidth=1, relheight=0.9, relx=0)
display_students()
root.update()
root.mainloop()