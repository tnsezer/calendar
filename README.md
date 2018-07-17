###There may be two roles that use this API, a candidate and an interviewer. A typical scenario
is when:
1. An interview slot is a 1-hour period of time that spreads from the beginning of any hour until
the beginning of the next hour. For example, a time span between 9am and 10am is a valid
interview slot, whereas between 9:30am and 10:30am it is not.
2. Each interviewer sets their own availability slot. For example, the interviewer Philipp is
available next week each day from 9am through 4pm without breaks and the interviewer Sarah
is available from 12pm to 6pm on Monday and Wednesday next week, and from 9am to 12pm
on Tuesday and Thursday.
3. Each candidate sets their own requested slots for the interview. For example, the candidate
Carl is available for the interview from 9am to 10am any weekday next week and from 10am
to 12pm on Wednesday.
4. Anyone may then query the API to get a collection of periods of time when it's possible to
arrange an interview for a particular candidate and one or more interviewers. In this example,
if the API is queries for the candidate Carl and interviewers Philipp and Sarah, the response
should be a collection of 1-hour slots: from 9am to 10am on Tuesday, from 9am to 10am on
Thursday.

### Run the project
php bin/console server:run

### Project url
http://127.0.0.1:8000/interview

### Documentation
There are 2 users type Candidate and Interviewer insteadof User class.
Every user classes accept Schedule for available periods, 
Appointment class for queries collection of periods.

