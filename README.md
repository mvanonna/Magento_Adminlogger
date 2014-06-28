Magento_Adminlogger
===================

Logger for Magento shops which has multiple admins, to see who is responsible for which action.


Initialize the module by adding the file Matthijs_Adminlogger.xml to etc/modules with the following content:

<config>
	<modules>
		<Matthijs_Adminlogger>
			<active>true</active>
			<codePool>local</codePool>
		</Matthijs_Adminlogger>
	</modules>
</config>

A new entry in the admin menu has now appeared which shows the adminlog.
