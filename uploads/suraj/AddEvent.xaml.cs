using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Runtime.InteropServices.WindowsRuntime;
using Windows.Foundation;
using Windows.Foundation.Collections;
using Windows.UI.Xaml;
using Windows.UI.Xaml.Controls;
using Windows.UI.Xaml.Controls.Primitives;
using Windows.UI.Xaml.Data;
using Windows.UI.Xaml.Input;
using Windows.UI.Xaml.Media;
using Windows.UI.Xaml.Navigation;
using Windows.ApplicationModel;
using Windows.UI.Notifications;
using Windows.Data.Xml.Dom;
using System.Text;
using Windows.Storage;
using Windows.Storage.Streams;

// The Blank Page item template is documented at http://go.microsoft.com/fwlink/?LinkId=234238

namespace App1
{
    /// <summary>
    /// An empty page that can be used on its own or navigated to within a Frame.
    /// </summary>
    public sealed partial class AddEvent : Page
    {
        public AddEvent()
        {
            this.InitializeComponent();
        }

        private async void button_click(object sender, RoutedEventArgs e)
        {

            /*    StorageFolder storageFolder = Windows.Storage.ApplicationData.Current.LocalFolder;
                StorageFile YesFile, AllFile;
                YesFile = await storageFolder.CreateFileAsync("yes.txt", CreationCollisionOption.OpenIfExists);
                AllFile = await storageFolder.CreateFileAsync("all.txt", CreationCollisionOption.OpenIfExists);
            */

            // result1.Text = text;
            //result2.Text = text1;
            //Toast xml before 15 min for exam;
            ToastTemplateType toastType = ToastTemplateType.ToastText02;

            XmlDocument toastXml15MinExam = ToastNotificationManager.GetTemplateContent(toastType);

            XmlNodeList toastTextElement = toastXml15MinExam.GetElementsByTagName("text");
            toastTextElement[0].AppendChild(toastXml15MinExam.CreateTextNode("15 min left for exam"));
            toastTextElement[1].AppendChild(toastXml15MinExam.CreateTextNode("Get ready and rush."));

            IXmlNode toastNode = toastXml15MinExam.SelectSingleNode("/toast");
            ((XmlElement)toastNode).SetAttribute("duration", "long");
            ((XmlElement)toastNode).SetAttribute("launch", "1");

            ToastNotification toast = new ToastNotification(toastXml15MinExam);

            //ToastNotificationManager.CreateToastNotifier().Show(toast);

            // Toast xml before two days 
            ToastTemplateType toastTypeTwoDays = ToastTemplateType.ToastText02;

            XmlDocument toastXmlTwoDays = ToastNotificationManager.GetTemplateContent(toastTypeTwoDays);

            XmlNodeList toastTextElementTwoDays = toastXmlTwoDays.GetElementsByTagName("text");
            toastTextElementTwoDays[0].AppendChild(toastXmlTwoDays.CreateTextNode("2 Days left for Test"));
            toastTextElementTwoDays[1].AppendChild(toastXmlTwoDays.CreateTextNode("Do Prepare Well"));

            IXmlNode toastNodeTwoDays = toastXmlTwoDays.SelectSingleNode("/toast");
            ((XmlElement)toastNodeTwoDays).SetAttribute("duration", "long");
            ((XmlElement)toastNodeTwoDays).SetAttribute("launch", "1");

            ToastNotification toastTwoDays = new ToastNotification(toastXmlTwoDays);
            //ToastNotificationManager.CreateToastNotifier().Show(toast);

            //Toast xml 15 minute class
            ToastTemplateType toastType15MinClass = ToastTemplateType.ToastText02;

            XmlDocument toastXml15MinClass = ToastNotificationManager.GetTemplateContent(toastType15MinClass);

            XmlNodeList toastTextElement15MinClass = toastXml15MinClass.GetElementsByTagName("text");
            toastTextElement15MinClass[0].AppendChild(toastXml15MinClass.CreateTextNode("15 min left for class"));
            toastTextElement15MinClass[1].AppendChild(toastXml15MinClass.CreateTextNode("Get ready"));

            IXmlNode toastNode15MinClass = toastXml15MinClass.SelectSingleNode("/toast");
            ((XmlElement)toastNode15MinClass).SetAttribute("duration", "long");
            ((XmlElement)toastNode15MinClass).SetAttribute("launch", "1");

            ToastNotification toast15MinClass = new ToastNotification(toastXml15MinClass);
            //ToastNotificationManager.CreateToastNotifier().Show(toast);

            //Reminder set time
            var reminderSetTime = DateTime.Now;
            var check_date = reminderSetTime.Date;

            bool isAppointmentValid = true;

            var appointment = new Windows.ApplicationModel.Appointments.Appointment();

            // StartTime
            var date = startDate.Date;
            var time = StartTime.Time;
            var timeZoneOffset = TimeZoneInfo.Local.GetUtcOffset(DateTime.Now);
            var startTime = new DateTimeOffset(date.Year, date.Month, date.Day, time.Hours, time.Minutes, 0, timeZoneOffset);
            appointment.StartTime = startTime;

            //End Time
            var date1 = EndDate.Date;
            var time1 = EndTime.Time;
            var endTime = new DateTimeOffset(date1.Year, date1.Month, date1.Day, time1.Hours, time1.Minutes, 0, timeZoneOffset);
            appointment.Duration = endTime - appointment.StartTime;

            string subject = SelectionType.SelectedValue.ToString();

            /*String appointmentId = await Windows.ApplicationModel.Appointments.AppointmentManager.ShowEditNewAppointmentAsync(appointment);

            if(appointmentId != String.Empty)
            {
                result.Text = "Appointment Id = " + appointmentId;
            }
            else
            {
                result.Text = "Some error occured";
            }*/


            //  result.Text = appointment.Duration.ToString() + "You selected " + subject;

            if (subject == "Test")
            {
                DateTime abc = startTime.AddDays(-2).DateTime;
                if (DateTime.Compare(abc, check_date) > 0)
                {
                    //result.Text = "More than two days";
                    int x = abc.Year;
                    int y = abc.Month;
                    int z = abc.Day;
                    int a = time.Hours;
                    int b = time.Minutes;

                    DateTime EventDate = new DateTime(x, y, z, a, b, 0);
                    TimeSpan NotTime = EventDate.Subtract(DateTime.Now);
                    DateTime dueTime = DateTime.Now.Add(NotTime);

                    //result.Text = EventDate.ToString();
                    ScheduledToastNotification scheduledToast = new ScheduledToastNotification(toastXmlTwoDays, dueTime);
                    ToastNotificationManager.CreateToastNotifier().AddToSchedule(scheduledToast);
                }

                DateTime xyz = startTime.AddMinutes(-15).DateTime;
                if (DateTime.Compare(xyz, check_date) > 0)
                {
                    int x = date.Year;
                    int y = date.Month;
                    int z = date.Day;
                    int a = xyz.TimeOfDay.Hours;
                    int b = xyz.TimeOfDay.Minutes;

                    DateTime EventDate = new DateTime(x, y, z, a, b, 0);
                    TimeSpan NotTime = EventDate.Subtract(DateTime.Now);
                    DateTime dueTime = DateTime.Now.Add(NotTime);

                    //result.Text = EventDate.ToString();
                    ScheduledToastNotification scheduledToast = new ScheduledToastNotification(toastXml15MinExam, dueTime);
                    ToastNotificationManager.CreateToastNotifier().AddToSchedule(scheduledToast);
                }
            }
            if (subject == "Class")
            {
                DateTime pqr = startTime.AddMinutes(-15).DateTime;
                if (DateTime.Compare(pqr, check_date) > 0)
                {
                    int x = date.Year;
                    int y = date.Month;
                    int z = date.Day;
                    int a = pqr.TimeOfDay.Hours;
                    int b = pqr.TimeOfDay.Minutes;

                    DateTime EventDate = new DateTime(x, y, z, a, b, 0);
                    TimeSpan NotTime = EventDate.Subtract(DateTime.Now);
                    DateTime dueTime = DateTime.Now.Add(NotTime);

                    //result.Text = EventDate.ToString();
                    ScheduledToastNotification scheduledToast = new ScheduledToastNotification(toastXml15MinClass, dueTime);
                    ToastNotificationManager.CreateToastNotifier().AddToSchedule(scheduledToast);
                }
            }


            /*int x = date.Year;
            int y = date.Month;
            int z = date.Day;
            int a = time.Hours;
            int b = time.Minutes;

            DateTime EventDate = new DateTime(x, y, z, a, b, 0);
            TimeSpan NotTime = EventDate.Subtract(DateTime.Now);
            DateTime dueTime = DateTime.Now.Add(NotTime);

            result.Text = EventDate.ToString();
            ScheduledToastNotification scheduledToast = new ScheduledToastNotification(toastXml15MinExam, dueTime);
            ToastNotificationManager.CreateToastNotifier().AddToSchedule(scheduledToast);
            */

            // Frame.Navigate(typeof(confirmation));

            //, SelectionType.SelectedValue.ToString());
        }

        private void BackToMainPage(object sender, RoutedEventArgs e)
        {
            Frame.Navigate(typeof(MainPage));
        }
    }
}
